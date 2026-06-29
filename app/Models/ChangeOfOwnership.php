<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeOfOwnership extends Model
{
    use HasFactory;

    protected $fillable = [
        // Existing fields
        'user_id',
        'user_email',
        'owner_id',
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
        'platenumber',
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

        // ✅ New fields matching your flow
        'date_of_birth',
        'place_of_birth',
        'lga',
        'state',
        'chassis_number',
        'engine_number',
        'vehicle_make',
        'vehicle_color',
        'road_worthiness_paper',
        'chassis_image',
        'nin_slip',
        'status',
    ];

    public function vehicleTypeInfo()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_category', 'id');
    }

    public function addVehicleOwnership()
    {
        return $this->belongsTo(AddVehicleOwnership::class, 'user_id', 'user_id');
    }

    public function ownerInfo()
    {
        return $this->belongsTo(AddVehicleOwnership::class, 'owner_id', 'id');
    }
}