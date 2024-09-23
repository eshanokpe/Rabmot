<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeofOwnershipPrice extends Model
{ 
    use HasFactory;
    protected $fillable = [ 
        'state_id',
        'vehicle_type_id',
        'random_vehicleLicense',
        'random_hacneyPermit',
        'random_policeCmris',
        'random_cost',
        'customised_vehicleLicense',
        'customised_hacneyPermit',
        'customised_policeCmris',
        'customised_cost',
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
