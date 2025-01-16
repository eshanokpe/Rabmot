<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\ProcessHistory;
use App\Models\AddVehicleOwnership; 
use App\Models\AddVehicleRegistration; 
use App\Models\User; 
use App\Models\ReferralLog; 
use App\Models\AddVehicleRenewal; 
 
class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $userId = Auth::user()->id;
        $email = Auth::user()->email;
        $user = Auth::user(); 
        $user = User::find($userId);

        $data['tokenCount'] = $user->latestTokenCount();
        $data['referralsCount'] = $user->referrer_count;
        $data['referralLink'] = route('signup') . '?ref=' . $user->referral_code;
        $data['vehicle'] = AddVehicleRenewal::where('user_id', $userId)->get();
        $data['vehicleCount'] = $data['vehicle']->count(); 
        $data['getaddvehicle'] = AddVehicleRenewal::with('vehicleTypeInfo')->where('user_id', $userId)->get();
       
        $data['referrals'] = ReferralLog::where('referrer_id', $userId)
        ->with('referredUser') 
        ->get();
        $data['orderCount'] = ProcessHistory::where('user_id', $userId)
                                            ->where('user_email', $email)
                                            ->where('status', 0)
                                            ->count();
        $data['vehicleCount'] = AddVehicleRenewal::where('user_id', $userId)->where('user_email', $email)->count();
        $data['ownershipCount'] = AddVehicleOwnership::where('user_id', $userId)->where('user_email', $email)->count();
        $data['registrationCount'] = AddVehicleRegistration::where('user_id', $userId)->where('user_email', $email)->count();

        $data['totalCountVehicle'] = $data['vehicleCount'] + $data['ownershipCount'] + $data['registrationCount'];
 

        return view('user.pages.referralDetails', $data);
    }
}
