<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\AddVehicleRenewal; 
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

        $tokenCount = $user->latestTokenCount();
        $referralsCount = $user->referrer_count;
        $referralLink = route('signup') . '?ref=' . $user->referral_code;
        $vehicle = AddVehicleRenewal::where('user_id', $id)->get();
        $vehicleCount = $vehicle->count(); 
        $getaddvehicle = AddVehicleRenewal::with('vehicleTypeInfo')->where('user_id', $id)->get();
        
        return view('user.home', compact('vehicleCount','getaddvehicle','referralLink', 'referralsCount','tokenCount'));
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

       return view('user.pages.faq', compact('id', 'email'));
    }

}
