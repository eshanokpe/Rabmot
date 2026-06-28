<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class VehicleRenewalPrice extends Model
{
    use HasFactory;
    protected $table = 'vehicle_renewal_prices'; 
    protected $fillable = [ 
        'vehicleType_id',
        'state_id',
        'vehicle_license',
        'road_worthiness',
        'third_party_insurance',
        'proof_of_ownership',
        'hackney_permit',
        'vehicle_inspection_pickanddrop',
        'police_cmris'
    ];

    public function stateInfo()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    
    public function VehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicleType_id', 'id');
    }
  
}
