<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'referred_id',
        'referral_code',
        'referred_at',
    ]; 
    protected $casts = [
        'referred_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }
    

    /**
     * Get the referred (user) associated with this referral log.
     */
    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }
}
 