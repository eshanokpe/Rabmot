<?php

namespace App\Models;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Property;

class Notification extends DatabaseNotification
{
    use HasFactory;

    protected $table = 'notifications';
 
    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];

    protected $casts = [
        'id' => 'string',
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public function markAsRead()
    {
        return $this->forceFill(['read_at' => $this->freshTimestamp()])->save();
    }

    public function markAsUnread()
    {
        return $this->forceFill(['read_at' => null])->save();
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

}
