<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * One expiry reminder attempt for a vehicle document, on one channel
 * (email, sms or whatsapp). admin_id is null for the automatic daily job.
 */
class DocumentReminder extends Model
{
    protected $table = 'document_reminders';

    protected $fillable = [
        'source',
        'record_id',
        'document_field',
        'channel',
        'status',
        'reminder_point',
        'expiry_date',
        'recipient',
        'message',
        'error_message',
        'admin_id',
        'admin_name',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
