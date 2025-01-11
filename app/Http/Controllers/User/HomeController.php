<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Models\FAQs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\AddVehicleOwnership; 
use App\Models\AddVehicleRegistration; 
use App\Models\AddVehicleRenewal; 
use App\Models\Order;
use App\Models\User;
use App\Models\VehicleType;
use App\Models\ProcessHistory;
use App\Models\VehicleRegistrationType;
use App\Models\OtherPermitPrice;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $user = Auth::user(); 
        $user = User::find($id);

        $data['tokenCount'] = $user->latestTokenCount();
        $data['referralsCount'] = $user->referrer_count;
        $data['referralLink'] = route('signup') . '?ref=' . $user->referral_code;

        $data['vehicleCount'] = AddVehicleRenewal::where('user_id', $id)->count();
        $data['ownershipCount'] = AddVehicleOwnership::where('user_id', $id)->count();
        $data['registrationCount'] = AddVehicleRegistration::where('user_id', $id)->count();

        $data['orderCount'] = Order::where('user_id', $id)->count();

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
