<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddVehicleRenewal extends Model
{
    use HasFactory; 
    protected $table = 'addvehiclerenewals'; 
    public $fillable = [ 
        'user_id', 
        'userType',
        'user_email',
        'ownerfullname',
        'owneremail',
        'category',
        'vehiclemake',
        'vehiclemodel',
        'year0fmake',
        'platenumber',
        'chassisnumber',
        'enginenumber', 
        'vehiclecolor',
        'vehiclename', 
        'vehicledocumentname',
        'ownersphonenumber',
        'registeredaddressofvehicle',
        'emailAddress',
        
        'vehiclelicenseexpiry',
        'insuranceexpiry',
        'roadworthinessexpiry',
        'hackneypermitexpiry',
        'statecarriagepermitexpiry',
        'hackneydutypermitexpiry',
        'localgovernmentpermitexpiry',

        'vehiclelicensepapers',
        'insurancepapers',
        'roadworthinesspapers',
        'hackneypermitpaper',
        'statecarriagepermit', 
        'localgovernmentpermit',
        'midyearpermit', 
        'meansofid',
    ];

    
    public function vehicleTypeInfo()
    {
        return $this->belongsTo(VehicleType::class, 'category');
    }

    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
