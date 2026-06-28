<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewDriverLicense extends Model
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
        'middlename',
        'lastname',
        'mothermaidenname',
        'email',
        'gender',
        'dateofbirth',
        'maritalstatus',
        'nin',
        'localgovernment',
        'state',
        'localgovtplaceofbirth',
        'phonenumber',
        'bloodgroup',
        'height',
        'nextofkinname',
        'nextofkinphonenumber',
        'address',
        'payment_status',
        'totalamount',
    ];
}
 