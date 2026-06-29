<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRegistration extends Model
{
    use HasFactory;

    // Added ALL fields used in the form/application
    protected $fillable = [
        // Existing fields
        'user_id',
        'user_email',
        'owner_id',
        'userType', 
        'ownerEmail',
        'process_id',
        'process_type',
        'category',
        'registrationType',
        'plateNumberType',
        'preferredNumber',
        'hackneyPermit',
        'policeCMRIS',
        'payment_status',
        'totalamount',

        // New fields from your form
        'fullname',
        'gender',
        'marital_status',
        'dob',
        'address',
        'lga',
        'state',
        'phone',
        'email',
        'nin',
        'chassis_number',
        'engine_number',
        'vehicle_make',
        'vehicle_model',
        'year',
        'color',
        'fuel_type',
        'doc_custom_papers',
        'doc_chassis_photo',
        'doc_nin_slip',
        'doc_address_proof',
        'status', // pending / approved / rejected
    ];

    public function vehicleType(){
        return $this->hasMany(VehicleType::class, 'category', 'id');
    }  

    public function categoryInfo()
    {
        return $this->belongsTo(VehicleType::class, 'category', 'id');
    }

    public function vehicleregistrationType()
    {
        return $this->belongsTo(VehicleRegistrationType::class, 'registrationType', 'id');
    }
    
    public function ownerInfo()
    {
        return $this->belongsTo(AddVehicleRegistration::class, 'owner_id', 'id');
    }
}