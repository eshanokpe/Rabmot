<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'title', 'body', 'target_audience',
        'target_ids', 'channels', 'scheduled_at', 'sent_at',
        'delivery_status', 'delivery_report'
    ]; 

    protected $casts = [
        'target_ids' => 'array',
        'channels' => 'array',
        'delivery_report' => 'array',
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function deliveries()
    {
        return $this->hasMany(BroadcastDelivery::class);
    }
}