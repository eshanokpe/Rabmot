<?php

namespace App\Services;

use App\Models\AddVehicleRenewal;
use App\Models\WhatsappReminder;
use Carbon\Carbon;

class WhatsappReminderService
{
    /**
     * Expiry date fields on a vehicle renewal and their human-readable labels.
     */
    public const DOCUMENT_FIELDS = [
        'vehiclelicenseexpiry'        => 'Vehicle License',
        'insuranceexpiry'             => 'Insurance',
        'roadworthinessexpiry'        => 'Road Worthiness',
        'hackneypermitexpiry'         => 'Hackney Permit',
        'statecarriagepermitexpiry'   => 'State Carriage Permit',
        'hackneydutypermitexpiry'     => 'Mid-Year (Hackney Duty) Permit',
        'localgovernmentpermitexpiry' => 'Local Government Permit',
    ];

    public function alertWindowDays(): int
    {
        return max(0, (int) config('whatsapp_reminders.alert_window_days', 30));
    }

    /**
     * Documents on this record whose expiry falls within the alert window,
     * each with its pre-filled message, wa.me link and latest reminder log.
     */
    public function expiringDocuments(AddVehicleRenewal $vehicle): array
    {
        $today = Carbon::today();
        $window = $this->alertWindowDays();
        $phone = $this->normalizePhoneNumber($vehicle->ownersphonenumber);

        $lastReminders = WhatsappReminder::where('vehicle_renewal_id', $vehicle->id)
            ->latest()
            ->get()
            ->unique('document_field')
            ->keyBy('document_field');

        $documents = [];

        foreach (self::DOCUMENT_FIELDS as $field => $label) {
            if (empty($vehicle->$field)) {
                continue;
            }

            $expiryDate = Carbon::parse($vehicle->$field)->startOfDay();
            $daysRemaining = (int) $today->diffInDays($expiryDate, false);

            if ($daysRemaining < 0 || $daysRemaining > $window) {
                continue;
            }

            $message = $this->buildMessage($vehicle, $label, $expiryDate);

            $documents[] = [
                'field'          => $field,
                'label'          => $label,
                'expiry_date'    => $expiryDate,
                'days_remaining' => $daysRemaining,
                'phone'          => $phone,
                'message'        => $message,
                'whatsapp_url'   => $phone ? $this->whatsappUrl($phone, $message) : null,
                'last_reminder'  => $lastReminders->get($field),
            ];
        }

        return $documents;
    }

    public function buildMessage(AddVehicleRenewal $vehicle, string $documentLabel, Carbon $expiryDate): string
    {
        $clientName = trim($vehicle->ownerfullname ?: optional($vehicle->user)->name ?: 'there');
        $link = rtrim((string) config('whatsapp_reminders.renewal_link'), '/');

        return "Hi {$clientName}, this is a reminder that your {$documentLabel} is expiring on "
            . $expiryDate->format('F j, Y')
            . ". Please reach out to us or visit {$link} to begin your renewal before it expires.";
    }

    public function whatsappUrl(string $phone, string $message): string
    {
        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }

    /**
     * Normalise a phone number to the digits-only international format wa.me
     * expects (e.g. 08031234567 -> 2348031234567). Returns null when the
     * number is missing or malformatted.
     */
    public function normalizePhoneNumber(?string $phone): ?string
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
        } elseif (strlen($number) === 10 && !str_starts_with($number, '0')) {
            $number = '234' . $number;
        }

        // Nigerian numbers must be exactly 234 + 10 digits; anything else must
        // be a plausible E.164 number that doesn't start with a trunk 0.
        if (str_starts_with($number, '234')) {
            return preg_match('/^234[789]\d{9}$/', $number) ? $number : null;
        }

        return preg_match('/^[1-9]\d{7,14}$/', $number) ? $number : null;
    }
}
