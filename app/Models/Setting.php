<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'site_name',
        'support_email',
        'support_phone',
        'mail_from_address',
        'mail_from_name',
        'sms_provider',
        'sms_api_key',
        'sms_api_secret',
        'sms_sender_id',
        'whatsapp_api_token',
        'whatsapp_phone_number_id',
        'whatsapp_business_account_id',
        'currency_code',
        'currency_symbol',
        'timezone',
        'maintenance_message',
        'updated_by',
    ];

    protected static ?self $cached = null;

    public static function current(): self
    {
        return static::$cached ??= static::first() ?? new static();
    }

    public static function forgetCache(): void
    {
        static::$cached = null;
    }

    public static function mailFrom(): array
    {
        $settings = static::current();

        return [
            $settings->mail_from_address ?: 'info@rabmotlicensing.com',
            $settings->mail_from_name ?: 'Rabmot Licensing Agency',
        ];
    }
}
