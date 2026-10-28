<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappReminder extends Model
{
    protected $table = 'whatsapp_reminders';

    protected $fillable = [
        'vehicle_renewal_id',
        'document_field',
        'expiry_date',
        'recipient_phone',
        'message',
        'admin_id',
        'admin_name',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function vehicleRenewal()
    {
        return $this->belongsTo(AddVehicleRenewal::class, 'vehicle_renewal_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
