<?php

namespace App\Support;

class PhoneNumber
{
    /**
     * Normalise a phone number to the digits-only international format used by
     * Termii and wa.me (e.g. 08031234567 -> 2348031234567). Returns null when
     * the number is missing or malformatted.
     */
    public static function normalize(?string $phone): ?string
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

    public static function whatsappUrl(string $phone, string $message): string
    {
        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }
}
