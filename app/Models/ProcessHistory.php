<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'userType',
        'user_email',
        'userType',
        'process_number',
        'process_id' ,
        'process_type' ,
        'process_DLR_lengthofyears',
        'process_NDL_lengthofyear',
        'process_CO_vc',
        'process_CO_vl' ,
        'process_VR_name',
        'process_VR_vehicleregistrationType' ,
        'process_VR_numberplate', 
        'process_VR_preferrednumber', 
        'process_VPR_vehicleType', 
        'process_VPR_vehicleLicense', 
        'process_VPR_roadWorthiness', 
        'process_VPR_thirdPartyInsurance', 
        'process_VPR_vehicleInspectionPickanddrop', 
        'process_VPR_hackneyPermit', 
        'process_DPN_processtype', 
        'process_DPN_fullname', 
        'totalamount',
        'status', 
    ];
}
