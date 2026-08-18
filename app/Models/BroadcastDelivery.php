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
        'channel',
        'status',
        'error_message',
        'delivered_at',
    ];

    protected $casts = [
        'delivered_at' => 'datetime',
    ];

    public function broadcast()
    {
        return $this->belongsTo(Broadcast::class);
    }
}
