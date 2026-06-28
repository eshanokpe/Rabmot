<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalDriverLicense extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'user_email',
        'userType',
        'process_id',
        'process_type',
        'lengthofyear',
        'firstname',
        'middlename',
        'lastname' ,
        'email',
        'gender',
        'dateofbirth',
        'maritalstatus',
        'address',
        'localgovernment',
        'state',
        'localgovtplaceofbirth',
        'phonenumber',
        'passport',
        'totalAmount',
    ];
}
 