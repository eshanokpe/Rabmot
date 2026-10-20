<?php

namespace App\Services;

use App\Mail\BroadcastMail;
use App\Models\Agent;
use App\Models\Broadcast;
use App\Models\BroadcastDelivery;
use App\Models\Notifications;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BroadcastDispatchService
{
    public const LARGE_AUDIENCE_THRESHOLD = 100;

    public function resolveRecipients(string $audience, ?array $targetIds): Collection
    {
        return match ($audience) {
            'all_users' => User::all(),
            'all_agents' => Agent::all(),
            'all_consumers' => User::where('role', 'consumer')->get(),
            'specific_user' => User::whereIn('id', $targetIds ?? [])->get(),
            'specific_agent' => Agent::whereIn('id', $targetIds ?? [])->get(),
            default => collect(),
        };
    }

    public function countRecipients(string $audience, ?array $targetIds): int
    {
        return match ($audience) {
            'all_users' => User::count(),
            'all_agents' => Agent::count(),
            'all_consumers' => User::where('role', 'consumer')->count(),
            'specific_user' => User::whereIn('id', $targetIds ?? [])->count(),
            'specific_agent' => Agent::whereIn('id', $targetIds ?? [])->count(),
            default => 0,
        };
    }

    public function shouldDefer(int $recipientCount): bool
    {
        return $recipientCount > self::LARGE_AUDIENCE_THRESHOLD;
    }

    public function send(Broadcast $broadcast): void
    {
        $recipients = $this->resolveRecipients($broadcast->target_audience, $broadcast->target_ids);
        $channels = $broadcast->channels ?? [];

        $report = ['total' => $recipients->count(), 'success' => 0, 'failed' => 0];

        foreach ($recipients as $recipient) {
            $recipientType = $recipient instanceof Agent ? 'agent' : 'user';
            $recipientFailed = false;

            if (in_array('in_app', $channels) && !$this->sendInApp($broadcast, $recipient, $recipientType)) {
                $recipientFailed = true;
            }

            if (in_array('email', $channels) && !$this->sendEmail($broadcast, $recipient, $recipientType)) {
                $recipientFailed = true;
            }

            if (in_array('sms', $channels) && !$this->sendSms($broadcast, $recipient, $recipientType)) {
                $recipientFailed = true;
            }

            if (in_array('whatsapp', $channels) && !$this->sendWhatsapp($broadcast, $recipient, $recipientType)) {
                $recipientFailed = true;
            }

            $recipientFailed ? $report['failed']++ : $report['success']++;
        }

        $broadcast->update([
            'delivery_report' => $report,
            'delivery_status' => $this->resolveOverallStatus($report),
            'sent_at' => now(),
        ]);
    }

    private function sendInApp(Broadcast $broadcast, $recipient, string $recipientType): bool
    {
        try {
            Notifications::create([
                'user_id' => $recipient->id,
                'user_email' => $recipient->email,
                'fullname' => $recipient->fullname,
                'userType' => $recipientType,
                'type' => 'broadcast',
                'title' => $broadcast->title,
                'message' => $broadcast->body,
                'read_at' => null,
            ]);

            $this->recordDelivery($broadcast, $recipient, $recipientType, 'in_app', 'sent');

            return true;
        } catch (\Throwable $e) {
            Log::error("Broadcast in-app delivery failed for {$recipientType} {$recipient->id}: {$e->getMessage()}");
            $this->recordDelivery($broadcast, $recipient, $recipientType, 'in_app', 'failed', $e->getMessage());

            return false;
        }
    }

    private function sendEmail(Broadcast $broadcast, $recipient, string $recipientType): bool
    {
        try {
            Mail::to($recipient->email)->send(new BroadcastMail($broadcast));
            $this->recordDelivery($broadcast, $recipient, $recipientType, 'email', 'sent');

            return true;
        } catch (\Throwable $e) {
            Log::error("Broadcast email delivery failed for {$recipientType} {$recipient->id}: {$e->getMessage()}");
            $this->recordDelivery($broadcast, $recipient, $recipientType, 'email', 'failed', $e->getMessage());

            return false;
        }
    }

    private function sendSms(Broadcast $broadcast, $recipient, string $recipientType): bool
    {
        $phone = $this->normalizePhoneNumber($recipient->phone ?? $recipient->phone_no ?? null);
        if (!$phone) {
            $this->recordDelivery($broadcast, $recipient, $recipientType, 'sms', 'failed', 'Recipient has no valid phone number.');

            return false;
        }

        $settings = Setting::current();
        $apiKey = config('services.termii.api_key') ?: $settings->sms_api_key;
        $senderId = config('services.termii.sms_sender_id') ?: $settings->sms_sender_id;
        $isTermiiConfigured = (bool) config('services.termii.api_key')
            || strtolower((string) $settings->sms_provider) === 'termii';
        if (!$isTermiiConfigured || !$apiKey || !$senderId) {
            $this->recordDelivery($broadcast, $recipient, $recipientType, 'sms', 'failed', 'Termii SMS is not configured. Set TERMII_API_KEY and TERMII_SMS_SENDER_ID, or configure them in Settings.');

            return false;
        }

        return $this->sendTermiiMessage(
            $broadcast,
            $recipient,
            $recipientType,
            'sms',
            $phone,
            $senderId,
            'generic',
            $apiKey
        );
    }

    private function sendWhatsapp(Broadcast $broadcast, $recipient, string $recipientType): bool
    {
        $phone = $this->normalizePhoneNumber($recipient->phone ?? $recipient->phone_no ?? null);
        if (!$phone) {
            $this->recordDelivery($broadcast, $recipient, $recipientType, 'whatsapp', 'failed', 'Recipient has no valid phone number.');

            return false;
        }

        $settings = Setting::current();
        $apiKey = config('services.termii.api_key') ?: $settings->sms_api_key;
        $senderId = config('services.termii.whatsapp_sender_id') ?: $settings->whatsapp_sender_id;
        $isTermiiConfigured = (bool) config('services.termii.api_key')
            || strtolower((string) $settings->sms_provider) === 'termii';
        if (!$isTermiiConfigured || !$apiKey || !$senderId) {
            $this->recordDelivery($broadcast, $recipient, $recipientType, 'whatsapp', 'failed', 'Termii WhatsApp is not configured. Set TERMII_API_KEY and TERMII_WHATSAPP_SENDER_ID, or configure them in Settings.');

            return false;
        }

        return $this->sendTermiiMessage(
            $broadcast,
            $recipient,
            $recipientType,
            'whatsapp',
            $phone,
            $senderId,
            'whatsapp',
            $apiKey
        );
    }

    private function sendTermiiMessage(
        Broadcast $broadcast,
        $recipient,
        string $recipientType,
        string $channel,
        string $phone,
        string $sender,
        string $termiiChannel,
        string $apiKey
    ): bool {
        $plainTextBody = preg_replace(
            '/<\s*\/?(?:p|div|li|h[1-6]|br|blockquote)\b[^>]*>/i',
            ' ',
            $broadcast->body
        ) ?? $broadcast->body;
        $message = trim(preg_replace(
            '/\s+/u',
            ' ',
            html_entity_decode(strip_tags($plainTextBody), ENT_QUOTES | ENT_HTML5, 'UTF-8')
        ) ?? '');

        if ($message === '') {
            $this->recordDelivery($broadcast, $recipient, $recipientType, $channel, 'failed', 'The broadcast has no plain-text message to send.');

            return false;
        }

        try {
            $baseUrl = rtrim((string) config('services.termii.base_url'), '/');
            if (!str_ends_with($baseUrl, '/api')) {
                $baseUrl .= '/api';
            }

            $response = Http::acceptJson()
                ->asJson()
                ->timeout(15)
                ->post($baseUrl . '/sms/send', [
                    'api_key' => $apiKey,
                    // 'to' => $phone,
                    "to" => "2348139267960",
                    'from' => $sender,
                    'sms' => $message,
                    'type' => 'plain',
                    'channel' => $termiiChannel,
                ]);

            $accepted = $response->successful()
                && (
                    strtolower((string) $response->json('code')) === 'ok'
                    || (string) $response->json('message_id') !== ''
                );

            if (!$accepted) {
                Log::error("Termii {$channel} delivery failed for {$recipientType} {$recipient->id}.", [
                    'http_status' => $response->status(),
                ]);
                $this->recordDelivery(
                    $broadcast,
                    $recipient,
                    $recipientType,
                    $channel,
                    'failed',
                    "Termii rejected the message (HTTP {$response->status()})."
                );

                return false;
            }

            Log::info("Termii {$channel} delivery accepted for {$recipientType} {$recipient->id}.", [
                'http_status' => $response->status(),
                'code' => $response->json('code'),
                'message_id' => $response->json('message_id') ?? $response->json('message_id_str'),
                'message' => $response->json('message'),
                'balance' => $response->json('balance'),
            ]);

            $this->recordDelivery($broadcast, $recipient, $recipientType, $channel, 'sent');

            return true;
        } catch (\Throwable $e) {
            Log::error("Termii {$channel} delivery failed for {$recipientType} {$recipient->id}: {$e->getMessage()}");
            $this->recordDelivery($broadcast, $recipient, $recipientType, $channel, 'failed', 'Unable to connect to Termii.');

            return false;
        }
    }

    private function normalizePhoneNumber(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        $number = preg_replace('/\D+/', '', $phone);
        if (!$number) {
            return null;
        }

        if (str_starts_with($number, '00')) {
            $number = substr($number, 2);
        }

        if (strlen($number) === 14 && str_starts_with($number, '2340')) {
            $number = '234' . substr($number, 4);
        }

        if (strlen($number) === 11 && str_starts_with($number, '0')) {
            $number = '234' . substr($number, 1);
        } elseif (strlen($number) === 10) {
            $number = '234' . $number;
        }

        if (strlen($number) < 8 || strlen($number) > 15) {
            return null;
        }

        return $number;
    }

    private function recordDelivery(Broadcast $broadcast, $recipient, string $recipientType, string $channel, string $status, ?string $errorMessage = null): void
    {
        BroadcastDelivery::create([
            'broadcast_id' => $broadcast->id,
            'recipient_type' => $recipientType,
            'recipient_id' => $recipient->id,
            'recipient_email' => $recipient->email,
            'recipient_phone' => $recipient->phone ?? $recipient->phone_no ?? null,
            'channel' => $channel,
            'status' => $status,
            'error_message' => $errorMessage,
            'delivered_at' => $status === 'sent' ? now() : null,
        ]);
    }

    private function resolveOverallStatus(array $report): string
    {
        if ($report['total'] === 0) {
            return 'sent';
        }

        if ($report['success'] === 0) {
            return 'failed';
        }

        return $report['failed'] > 0 ? 'partial' : 'sent';
    }
}
