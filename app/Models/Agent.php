<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable
{
    use Notifiable;

    use HasFactory;
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
    ];
}
 