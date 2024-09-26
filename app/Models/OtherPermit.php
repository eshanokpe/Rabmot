<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPermit extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'user_email',
        'userType',
        'process_id',
        'process_type',
        'permittype',
        'amount',
        'firstname',
        'middlename',
        'lastname' ,
        'mothermaidenname',
        'email',
        'nin',
        'gender',
        'dateofbirth',
        'maritalstatus',
        'localgovernment', 
        'state',
        'localgovtplaceofbirth',
        'phonenumber',
        'bloodgroup',
        'height',
        'nextofkinname',
        'nextofkinphonenumber',
        'address',
        'passport',
        'meansofID',
        'proofofownership',

        'nameofvehicledocuments',
        'vehicle_make',
        'vehicle_model',
        'reg_number',
        'pictureoftheVehicleLicense',

        'affidavit',
        'policereport',
        'purpose',

        'lengthofyears',
        'nameondriver',
        'driverlicensenumber',
        'nextofkin',
        'nextofkinphone_no',
        'classoflicense',
        'reasonfor',
    ];

    public function permitInfo() 
    {
        return $this->belongsTo(OtherPermitType::class, 'permittype', 'id');
    } 
}
