<?php

namespace App\Services;

use App\Mail\BroadcastMail;
use App\Models\Agent;
use App\Models\Broadcast;
use App\Models\BroadcastDelivery;
use App\Models\Notifications;
use App\Models\Setting;
use App\Models\User;
use App\Support\PhoneNumber;
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

    /**
     * How many of the audience have a phone number WhatsApp/SMS can use.
     */
    public function countValidPhones(string $audience, ?array $targetIds): int
    {
        $phones = match ($audience) {
            'all_users' => User::pluck('phone'),
            'all_agents' => Agent::pluck('phone_no'),
            'all_consumers' => User::where('role', 'consumer')->pluck('phone'),
            'specific_user' => User::whereIn('id', $targetIds ?? [])->pluck('phone'),
            'specific_agent' => Agent::whereIn('id', $targetIds ?? [])->pluck('phone_no'),
            default => collect(),
        };

        return $phones->filter(fn ($phone) => PhoneNumber::normalize($phone) !== null)->count();
    }

    /**
     * WhatsApp goes through Termii when it is configured; otherwise each
     * recipient is queued for an admin to send manually via a wa.me link.
     */
    public function isWhatsappApiConfigured(): bool
    {
        $settings = Setting::current();
        $apiKey = config('services.termii.api_key') ?: $settings->sms_api_key;
        $senderId = config('services.termii.whatsapp_sender_id') ?: $settings->whatsapp_sender_id;
        $isTermiiConfigured = (bool) config('services.termii.api_key')
            || strtolower((string) $settings->sms_provider) === 'termii';

        return $isTermiiConfigured && $apiKey && $senderId;
    }

    public function shouldDefer(int $recipientCount): bool
    {
        return $recipientCount > self::LARGE_AUDIENCE_THRESHOLD;
    }

    public function send(Broadcast $broadcast): void
    {
        $recipients = $this->resolveRecipients($broadcast->target_audience, $broadcast->target_ids);
        $channels = $broadcast->channels ?? [];
        $manualWhatsapp = in_array('whatsapp', $channels) && !$this->isWhatsappApiConfigured();

        $report = ['total' => $recipients->count(), 'success' => 0, 'failed' => 0];
        if ($manualWhatsapp) {
            $report['whatsapp_manual'] = true;
            $report['whatsapp_pending'] = 0;
        }

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

            if ($manualWhatsapp) {
                if ($this->queueManualWhatsapp($broadcast, $recipient, $recipientType)) {
                    $report['whatsapp_pending']++;
                } else {
                    $recipientFailed = true;
                }
            } elseif (in_array('whatsapp', $channels) && !$this->sendWhatsapp($broadcast, $recipient, $recipientType)) {
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
            'DND',
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

    /**
     * Record a pending WhatsApp delivery for an admin to send by hand.
     * Returns false when the recipient has no usable phone number.
     */
    private function queueManualWhatsapp(Broadcast $broadcast, $recipient, string $recipientType): bool
    {
        $phone = $this->normalizePhoneNumber($recipient->phone ?? $recipient->phone_no ?? null);
        if (!$phone) {
            $this->recordDelivery($broadcast, $recipient, $recipientType, 'whatsapp', 'failed', 'No valid phone number on record');

            return false;
        }

        $this->recordDelivery($broadcast, $recipient, $recipientType, 'whatsapp', 'pending', null, $phone);

        return true;
    }

    /**
     * Personalised WhatsApp text for a manual send. $template overrides the
     * broadcast's own plain-text message when the admin edited it.
     */
    public function manualWhatsappMessage(Broadcast $broadcast, ?string $recipientName, ?string $template = null): string
    {
        $template = trim((string) $template) ?: $this->plainTextMessage($broadcast);
        $name = trim((string) $recipientName);

        return ($name !== '' ? "Hi {$name},\n\n" : '') . $template;
    }

    /**
     * Mark a pending manual WhatsApp delivery as sent by the given admin and
     * settle the broadcast's status once nothing is left pending. Returns
     * false if the delivery was already sent (e.g. a double click).
     */
    public function markManualWhatsappSent(BroadcastDelivery $delivery, $admin): bool
    {
        $updated = BroadcastDelivery::whereKey($delivery->id)
            ->where('status', 'pending')
            ->update([
                'status' => 'sent',
                'delivered_at' => now(),
                'sent_by_admin_id' => $admin->id,
                'sent_by_admin_name' => $admin->name,
            ]);

        if (!$updated) {
            return false;
        }

        $broadcast = $delivery->broadcast;
        $report = $broadcast->delivery_report ?? [];
        $report['whatsapp_pending'] = $broadcast->deliveries()
            ->where('channel', 'whatsapp')
            ->where('status', 'pending')
            ->count();

        $broadcast->update([
            'delivery_report' => $report,
            'delivery_status' => $this->resolveOverallStatus($report),
        ]);

        return true;
    }

    /**
     * The broadcast as plain text for SMS/WhatsApp: agency name, title, then
     * the body with its HTML stripped.
     */
    public function plainTextMessage(Broadcast $broadcast): string
    {
        $plainTextBody = preg_replace(
            '/<\s*br\s*\/?>|<\s*\/\s*(?:p|div|li|h[1-6]|blockquote)\s*>/i',
            "\n",
            $broadcast->body
        ) ?? $broadcast->body;
        $plainTextBody = html_entity_decode(strip_tags($plainTextBody), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $bodyLines = preg_split('/\R/u', $plainTextBody) ?: [];
        $bodyLines = array_map(
            fn (string $line): string => trim(preg_replace('/[ \t]+/u', ' ', $line) ?? $line),
            $bodyLines
        );
        $messageBody = trim(preg_replace('/\n{3,}/u', "\n\n", implode("\n", $bodyLines)) ?? '');
        $title = trim(html_entity_decode(strip_tags($broadcast->title), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        return "Rabmot Automobile Licensing Agency\n\n" . $title . ($messageBody !== '' ? "\n\n" . $messageBody : '');
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
        $message = $this->plainTextMessage($broadcast);

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
                    'to' => $phone,
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
        return PhoneNumber::normalize($phone);
    }

    private function recordDelivery(Broadcast $broadcast, $recipient, string $recipientType, string $channel, string $status, ?string $errorMessage = null, ?string $phone = null): void
    {
        BroadcastDelivery::create([
            'broadcast_id' => $broadcast->id,
            'recipient_type' => $recipientType,
            'recipient_id' => $recipient->id,
            'recipient_email' => $recipient->email,
            'recipient_phone' => $phone ?? $recipient->phone ?? $recipient->phone_no ?? null,
            'channel' => $channel,
            'status' => $status,
            'error_message' => $errorMessage,
            'delivered_at' => $status === 'sent' ? now() : null,
        ]);
    }

    private function resolveOverallStatus(array $report): string
    {
        if (($report['whatsapp_pending'] ?? 0) > 0) {
            return 'awaiting_whatsapp';
        }

        if ($report['total'] === 0) {
            return 'sent';
        }

        if ($report['success'] === 0) {
            return 'failed';
        }

        return $report['failed'] > 0 ? 'partial' : 'sent';
    }
}
