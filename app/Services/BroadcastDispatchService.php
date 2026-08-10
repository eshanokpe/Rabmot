<?php

namespace App\Services;

use App\Mail\BroadcastMail;
use App\Models\Agent;
use App\Models\Broadcast;
use App\Models\BroadcastDelivery;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Collection;
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

            if (in_array('whatsapp', $channels)) {
                $this->recordDelivery($broadcast, $recipient, $recipientType, 'whatsapp', 'skipped', 'WhatsApp not configured');
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

    private function recordDelivery(Broadcast $broadcast, $recipient, string $recipientType, string $channel, string $status, ?string $errorMessage = null): void
    {
        BroadcastDelivery::create([
            'broadcast_id' => $broadcast->id,
            'recipient_type' => $recipientType,
            'recipient_id' => $recipient->id,
            'recipient_email' => $recipient->email,
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
