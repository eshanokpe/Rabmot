<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\ProcessHistory;
use App\Models\User;
use App\Models\AddVehicleRenewal;
use App\Models\WalletPayment;
use App\Models\VehiclePaperRenewal;
use App\Models\VehicleRegistration;
use App\Models\ChangeofOwnershipPrice;
use App\Models\NewDriverLicense;
use App\Models\DriverLicenseRenewal;
use App\Models\InternationalDriverLicense;
use App\Models\DealerPlateNumber;
use App\Models\OtherPermit;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $userEmail = $user->email;

        if ($user->role !== 'admin') {
            return redirect()->route('index')->with('error', 'Unauthorized access.');
        }
        $userDetails = User::where('id', $user->id)->first();
        $items = ProcessHistory::where('status',0)->latest()->get();
        $countprocesshistory = ProcessHistory::count();
        $countdelivered = ProcessHistory::where('status', 4)->count();
        $countdeliveryinprogress = ProcessHistory::where('status', 3)->count();
        $countreadyfordelivery = ProcessHistory::where('status', 2)->count();
        $countprocessing = ProcessHistory::where('status', 1)->count();
        $countpending = ProcessHistory::where('status', 0)->count();
        $countVehiclepaperrenewal = VehiclePaperRenewal::count();
        $countVehiclepaperrenewal = VehiclePaperRenewal::count();
        $countVehicleRegistration = VehicleRegistration::count();
        $countChangeofownership = ChangeofOwnershipPrice::count();
        $countNewdriverlicense = NewDriverLicense::count();
        $countDriverlicenserenewal = DriverLicenseRenewal::count();
        $counInternationadriverlicense = InternationalDriverLicense::count();
        $counVehiclePlatenumber= DealerPlateNumber::count();
        $counOtherpermit= OtherPermit::count();
     
      return view('admin.dashboard', 
         compact(
            'user','userDetails',
            'items','countprocesshistory', 'countdelivered','countdeliveryinprogress',
            'countreadyfordelivery','countprocessing','countpending', 'countVehiclepaperrenewal',
            'countVehicleRegistration','countChangeofownership','countNewdriverlicense','countDriverlicenserenewal',
            'counInternationadriverlicense','counVehiclePlatenumber','counOtherpermit'
         )
      );
   }
}
