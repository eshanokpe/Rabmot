<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable
{
    use Notifiable;

    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'username',
        'email',
        'email_token',
        'fullname',
        'phone_no' ,
        'password',
        'location',
        'gender',
        'profile_image',
        'status',
        'userType',
        'approval_status',
        'approved_by',
        'approved_at',
        'rejection_reason',
        'means_of_identification_type',
        'means_of_identification',
        'passport_photograph',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }
}
 