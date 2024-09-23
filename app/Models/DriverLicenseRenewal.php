<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverLicenseRenewal extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'user_email',
        'userType',
        'process_id',
        'process_type',
        'state_id',
        'lengthofyear',
        'firstname',
        'middlename' ,
        'lastname',
        'dob',
        'email',
        'phone',
        'address',
        'document',
        'payment_status',
        'totalAmount',
    ];


} 
