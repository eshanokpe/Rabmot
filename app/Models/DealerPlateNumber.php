<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerPlateNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'user_email', 'userType', 'state_id', 'fullname', 'companyName',  'process_type', 'process_id', 'email',
        'phonenumber', 'gender', 'maritalstatus', 'dateofbirth', 'address',
        'placeofbirth', 'state', 'localgovernment', 'caccertificate', 'passport',
        'companyletterhead', 'payment_status', 'totalamount',
    ];
}
