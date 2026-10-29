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
        'nationality',
        'occupation',
        'gender',
        'dateofbirth',
        'maritalstatus',
        'nin',
        'localgovernment',
        'state',
        'placeofbirthstate',
        'localgovtplaceofbirth',
        'addresslocalgovernment',
        'phonenumber',
        'bloodgroup',
        'height',
        'facialmark',
        'glasses',
        'disability',
        'nextofkinname',
        'nextofkinphonenumber',
        'address',
        'payment_status',
        'totalamount',
        'status',
    ];
}