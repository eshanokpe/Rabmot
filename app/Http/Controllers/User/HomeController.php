<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Models\FAQs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Order;
use App\Models\User;
use App\Models\AddVehicleOwnership; 
use App\Models\AddVehicleRegistration; 
use App\Models\AddVehicleRenewal; 
use App\Models\InternationalDriverLicense;
use App\Models\NewDriverLicense;
use App\Models\VehiclePaperRenewal;
use App\Models\VehicleRegistration;
use App\Models\DriverLicenseRenewal;
use App\Models\OtherPermit;
use App\Models\VehicleType;
use App\Models\ProcessHistory;
use App\Models\VehicleRegistrationType;
use App\Models\OtherPermitPrice;
use App\Models\ChangeOfOwnership;
use App\Models\DealerPlateNumber;
use App\Models\Topic;
use App\Models\Wallet; 
use App\Models\ReferralLog; 
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public function index()
    {
        $user = auth()->user();
        $userId = Auth::user()->id;
        $email = Auth::user()->email;
        $data['referrals'] = ReferralLog::where('referrer_id', $userId)
        ->with('referredUser') 
        ->get();

        $referredIds = $data['referrals']->pluck('referred_id');

        foreach ($referredIds as $referredId) {
            $documentCount = $this->hasProcessedDocument($referredId);
            if ($documentCount == 1) {
            $referralLog = ReferralLog::where('referred_id', $referredId)->first();
            if ($referralLog && !$referralLog->rewarded) {
                $referrerId = $referralLog->referrer_id;
                $referrer = User::find($referrerId); 
                if ($referrer) {
                $referrer->addToWallet(100);
                $referralLog->rewarded = true;
                $referralLog->save();
                }
            }
            }
        }

        // dd($vehicleDocumentProcessed);
        $data['referrals'] = ReferralLog::where('referrer_id', $userId)
        ->with('referredUser') 
        ->get();
             
        // $user = Auth::user(); 
        $user = User::find($userId);
 
        $data['tokenCount'] = $user->latestTokenCount();
        $data['referralsCount'] = $user->referrer_count;

        $data['referralLink'] = route('signup') . '?ref=' . $user->referral_code;
        
        $data['vehicleCount'] = AddVehicleRenewal::where('user_id', $userId)->where('user_email', $email)->count();
        $data['ownershipCount'] = AddVehicleOwnership::where('user_id', $userId)->where('user_email', $email)->count();
        $data['registrationCount'] = AddVehicleRegistration::where('user_id', $userId)->where('user_email', $email)->count();

        $data['orderCount'] = ProcessHistory::where('user_id', $userId)
                                            ->where('user_email', $email)
                                            ->where('status', 0)
                                            ->count();
        $data['totalCountVehicle'] = $data['vehicleCount'] + $data['ownershipCount'] + $data['registrationCount'];
        $data['getaddvehicle'] = AddVehicleRenewal::with('vehicleTypeInfo')->where('user_id', $userId)->where('user_email', $email)->get();  
        $data['totalWalletAmount'] = Wallet::where('user_id', $userId)
                                    ->where('userType', 'user')
                                    ->where('user_email', $email)->sum('amount');  
          
        return view('user.home', $data);
    }

    public function hasProcessedDocument($referredUserId)
    {
        $data = ProcessHistory::where('user_id', $referredUserId)
                                    ->latest()
                                    ->count();
        return $data; 
    }
 
    public function addvehicle()
    {
        $id = Auth::user()->id;
        $vehicleList = VehicleType::all();

        return view('user.pages.addVehicle', compact('vehicleList'));
    }

    public function pricing()
    {
        $vehiclelist =  VehicleType::all();
        $vehiclecategories = VehicleRegistrationType::all();
        $states = State::all();
        $otherPermits = OtherPermitPrice::all();
          
        return view('user.pages.pricing', compact('vehiclelist', 'vehiclecategories','states','otherPermits'));
    }

    public function processHistory()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $processhistory = ProcessHistory::where('user_id', $id)
                                         ->latest()
                                        ->get();

        return view('user.pages.processhistory', compact('id', 'email', 'processhistory'));
    }

    public function deleteprocesshistory(Request $request){
        $id =  $request->itemId;
        $history = ProcessHistory::findOrFail($id);
        $history->delete();
        return response()->json([
            'message' => 'Process History deleted successfully', 
        ]);
    }

    public function transactionHistory()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $transactionhistory = ProcessHistory::where('user_id', $id)
                                       // ->where('status',0)
                                       ->where('user_email', $email)
                                       ->latest()
                                        ->get();

        return view('user.pages.transactionhistory', compact('id', 'email', 'transactionhistory'));
    }

    public function deletetransactionhistory(Request $request){
        $id =  $request->itemId;
        $history = ProcessHistory::findOrFail($id);
        $history->delete();
        return response()->json([
            'message' => 'Transaction History deleted successfully', 
        ]);
    }

    public function faq()
    { 
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $faqs = FAQs::all(); 

       return view('user.pages.faq', compact('id', 'email','faqs'));
    }

}
