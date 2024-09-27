<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_email',
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
        'payment_status' ,
        'totalamount', 
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
}
