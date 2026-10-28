<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadcastDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'broadcast_id',
        'recipient_type',
        'recipient_id',
        'recipient_email',
        'recipient_phone',
        'channel',
        'status',
        'error_message',
        'delivered_at',
        'sent_by_admin_id',
        'sent_by_admin_name',
    ];

    protected $casts = [
        'delivered_at' => 'datetime',
    ];

    public function broadcast()
    {
        return $this->belongsTo(Broadcast::class);
    }
}
