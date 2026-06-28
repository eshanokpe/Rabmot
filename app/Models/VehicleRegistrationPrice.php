<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRegistrationPrice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'state_id', 
        'vehicle_type_id',
        'random_private_vehicle_3rd_party_insurance',
        'customized_private_vehicle_3rd_party_insurance',
        'random_plate_private_vehicle_no_insurance',
        'customised_plate_private_vehicle_no_insurance',
        'random_commercial_plate_3rd_party_insurance',
        'customised_commercial_plate_3rd_party_insurance',
        'random_plate_no_commercial_vehicle_no_insurance',
        'customized_plate_no_commercial_vehicle_no_insurance',
        'random_plate_hackney_permit',
        'customized_plate_hackney_permit',
        'random_plate_police_cmris',
        'customised_plate_police_cmris',
    ];

    public function stateInfo() 
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    
    public function VehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }
}  
