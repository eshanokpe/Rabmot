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
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function processDocument(){
        $id = Auth::user()->id;
        $email = Auth::user()->email;

        $data['VehiclePaperRenewalCount'] = VehiclePaperRenewal::where('user_id', $id)
                                                    ->where('user_email', $email)
                                                    ->count();
        $data['VehicleRegistrationPriceCount'] = VehicleRegistration::where('user_id', $id)
                                                            ->where('user_email', $email)
                                                            ->count();
        $data['changeOfOwnershipCount'] = ChangeOfOwnership::where('user_id', $id)
                                                            ->where('user_email', $email)
                                                            ->count();
        $data['dealerPlateNumberCount'] = DealerPlateNumber::where('user_id', $id)
                                                            ->where('user_email', $email)
                                                            ->count();
        $data['driverLicenseRenewalCount'] = DriverLicenseRenewal::where('user_id', $id)
                                                            ->where('user_email', $email)
                                                            ->count();
        $data['internationalDriverLicenseCount'] = InternationalDriverLicense::where('user_id', $id)
                                                            ->where('user_email', $email)
                                                            ->count();
        $data['otherPermitCount'] = OtherPermit::where('user_id', $id)
                                                ->where('user_email', $email)
                                                ->count();
        $data['newDriverLicenseCount'] = NewDriverLicense::where('user_id', $id)
                                                ->where('user_email', $email)
                                                ->count();

        return $data;
    }

    public function index()
    {
        $vehicleDocumentProcessed = $this->processDocument(); // Simulate document processing logic
        dd($vehicleDocumentProcessed);
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        // $user = Auth::user(); 
        $user = User::find($id);
 
        $data['tokenCount'] = $user->latestTokenCount();
        $data['referralsCount'] = $user->referrer_count;

        $data['referralLink'] = route('signup') . '?ref=' . $user->referral_code;
        $data['vehicleCount'] = AddVehicleRenewal::where('user_id', $id)->count();
        $data['ownershipCount'] = AddVehicleOwnership::where('user_id', $id)->count();
        $data['registrationCount'] = AddVehicleRegistration::where('user_id', $id)->count();

        $data['orderCount'] = ProcessHistory::where('user_id', $id)
                                            ->where('user_email', $email)
                                            ->where('status', 0)
                                            ->count();

        $data['totalCountVehicle'] = $data['vehicleCount'] + $data['ownershipCount'] + $data['registrationCount'];
 
        $data['getaddvehicle'] = AddVehicleRenewal::with('vehicleTypeInfo')->where('user_id', $id)->get();
         
        return view('user.home', $data);
    }
 
    public function addvehicle()
    {
        $id = Auth::user()->id;
        $vehicleList = VehicleType::all();

        return view('user.pages.addVehicle', compact('vehicleList'));
    }

    public function pricing(){
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
