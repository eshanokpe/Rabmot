<?php

namespace App\Services;

use App\Models\AddVehicleRenewal;
use App\Models\WhatsappReminder;
use App\Support\PhoneNumber;
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
        return PhoneNumber::whatsappUrl($phone, $message);
    }

    public function normalizePhoneNumber(?string $phone): ?string
    {
        return PhoneNumber::normalize($phone);
    }
}
