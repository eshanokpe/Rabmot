<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddVehicleRegistration extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        'userType',
        'user_email',
        'ownerfullname',
        'owneremail',
        'category',
        'vehiclemake',
        'vehiclemodel',
        'year_of_make',
        'platenumber',
        'chassisnumber',
        'enginenumber',
        'vehiclecolor',
        'applicantfullname',
        'applicantNIN',
        'residentialaddress',
        'phonenumber',
        'emailaddress',
        'gender',
        'occupation',
        'year_of_make',
        'vehiclelicenseexpiry',
        'insuranceexpiry',
        'roadworthinessexpiry',
        'hackneypermitexpiry',
        'statecarriagepermitexpiry',
        'hackneydutypermitexpiry',
        'localgovernmentpermitexpiry',
        'dateofbirth',
        'maritalstatus',
        'state',
        'custompapers',
        'meansofid',
        'created_date' ,
        'created_month',
        'created_year',
        'created_at',
        'updated_at',
    ];

    public function categoryInfo()
    {
        return $this->belongsTo(VehicleCategory::class, 'category');
    }
} 
