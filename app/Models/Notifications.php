<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'user_id',
        'user_email',
        'fullname',
        'userType',
        'type',
        'title',
        'message',
        'read_at',
        // Vehicle expiry-specific columns
        'vehicle_id',
        'document_field',
        'days_threshold',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    // ─── Relationships ───────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(AddVehicleRenewal::class, 'vehicle_id');
    }

    // ─── Scopes ──────────────────────────────────────────────────

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ─── Helpers ─────────────────────────────────────────────────

    public function markAsRead(): void
    {
        if (is_null($this->read_at)) {
            $this->update(['read_at' => now()]);
        }
    }

    public function getIsReadAttribute(): bool
    {
        return ! is_null($this->read_at);
    }
}
