<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddVehicleOwnership extends Model
{
    use HasFactory; 
    public $fillable = [ 
        'user_id',
        'state_id',
        'userType',
        'user_email',
        'ownersfullname',
        'ownersemail',
        'category',
        'vehiclemake',
        'vehiclemodel',
        'yearofmake', 
        'platenumber',
        'chassisnumber',
        'enginenumber',
        'vehiclecolor',
        'vehiclepapername',
        'vehicledocumentname', 
        'registeredaddressofvehicle',
        'ownerfullname',
        'ownersNIN',
        'address',
        'phonenumber',
        'emailaddress',
        'gender',
        'occupation',
        'vehiclelicenseexpiry',
        'insuranceexpiry',
        'roadworthinessexpiry',
        'hackneypermitexpiry',
        'statecarriagepermitexpiry',
        'midyearpermit',
        'localgovernmentpermitexpiry',

        'vehiclelicensepapers',
        'proofofownership',
        'agreement',
        'meansofid',
    ];

    
    public function vehicleTypeInfo()
    {
        return $this->belongsTo(VehicleType::class, 'category');
    }
}
