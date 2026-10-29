<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Sends a single plain SMS through Termii, using the same configuration as
 * broadcasts (TERMII_* env values, falling back to the Settings page).
 */
class TermiiSmsSender
{
    /**
     * Returns null when Termii accepted the message, otherwise the reason it failed.
     */
    public function send(string $phone, string $message): ?string
    {
        $settings = Setting::current();
        $apiKey = config('services.termii.api_key') ?: $settings->sms_api_key;
        $senderId = config('services.termii.sms_sender_id') ?: $settings->sms_sender_id;
        $isTermiiConfigured = (bool) config('services.termii.api_key')
            || strtolower((string) $settings->sms_provider) === 'termii';

        if (!$isTermiiConfigured || !$apiKey || !$senderId) {
            return 'Termii SMS is not configured. Set TERMII_API_KEY and TERMII_SMS_SENDER_ID, or configure them in Settings.';
        }

        $baseUrl = rtrim((string) config('services.termii.base_url'), '/');
        if (!str_ends_with($baseUrl, '/api')) {
            $baseUrl .= '/api';
        }

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->timeout(15)
                ->post($baseUrl . '/sms/send', [
                    'api_key' => $apiKey,
                    'to' => $phone,
                    'from' => $senderId,
                    'sms' => $message,
                    'type' => 'plain',
                    'channel' => 'DND',
                ]);
        } catch (\Throwable $e) {
            Log::error("Termii SMS failed for {$phone}: {$e->getMessage()}");

            return 'Unable to connect to Termii.';
        }

        $accepted = $response->successful()
            && (
                strtolower((string) $response->json('code')) === 'ok'
                || (string) $response->json('message_id') !== ''
            );

        if (!$accepted) {
            Log::error("Termii SMS rejected for {$phone}.", ['http_status' => $response->status()]);

            return "Termii rejected the message (HTTP {$response->status()}).";
        }

        return null;
    }
}
