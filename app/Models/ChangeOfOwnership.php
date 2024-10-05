<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeOfOwnership extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_email',
        'userType',
        'process_id',
        'process_type',
        'vehicle_category',
        'vehiclelicenseexpiry_date',
        'fullname',
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
        'hackneydutypermitexpiry',
        'localgovernmentpermitexpiry',
        'policeCMRIS',
        
        'vehiclelicensepapers',
        'proofofownership',
        'agreement',
        'meansofid',
        'payment_status',
        'totalamount',
    ];

    public function vehicleTypeInfo()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_category', 'id');
    }

    public function addVehicleOwnership()
    {
        return $this->belongsTo(AddVehicleOwnership::class, 'user_id', 'user_id');
    }
}
