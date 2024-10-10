<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'username' ,
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
 