<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclePaperRenewal extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id', 
        'user_email',
        'ownerEmail',
        'userType',
        'process_id',
        'process_type',  
        'vehicleCategory',  
        'vehicleType',  
        'vehicleLicense',
        'roadWorthiness', 
        'thirdPartyInsurance',
        'proofOfOwnership',
        'hackneyPermit', 
        'vehicleInspectionPickanddrop',
        'policeCMRIS',
        'payment_status',
        'totalamount',
    ];

    public function categoryInfo()
    {
        return $this->belongsTo(VehicleType::class, 'vehicleCategory', 'id');
    }
}
