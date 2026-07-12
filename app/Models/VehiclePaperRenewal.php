<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // ✅ MISSING IMPORT ADDED

class VehiclePaperRenewal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_email',
        'owner_id',
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
        'expiry_date', // ✅ Make sure this is here too!
    ];

    // ✅ Add this cast so Carbon works correctly
    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function categoryInfo(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicleCategory', 'id');
    }

    public function ownerInfo(): BelongsTo
    {
        return $this->belongsTo(AddVehicleRenewal::class, 'owner_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}