<?php

namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use App\Models\FAQs;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Agent;
use App\Models\User;
use App\Models\Wallet;
use App\Models\VehicleType;
use App\Models\ProcessHistory;
use App\Models\OtherPermitPrice;
use App\Models\AddVehicleRenewal;
use App\Models\VehicleRenewalPrice;
use App\Models\VehicleRegistrationType;


use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('agent')->user();
      
        $userId = $user->id;
        $userEmail = $user->email;
        
        $userDetails = Agent::where('id', $user->id)->first();
        
        // $userDetails = User::where('id', $user->id)->with('agentDetails')->first();
        $totalWalletAmount = Wallet::where('user_id', $userId)
        ->where('userType', 'agent')
        ->where('user_email', $userEmail)->sum('amount');

        $getaddvehicle = AddVehicleRenewal::with('vehicleTypeInfo')
                                             ->where('user_id', $userId) 
                                             ->where('user_email', $userEmail)
                                             ->where('userType', 'Agent')->get();
       
        $vehicle = AddVehicleRenewal::where('user_id', $userId)
                                     ->where('user_email', $userEmail)
                                     ->where('userType', 'Agent')
                                     ->get(); 
        
        $vehicleCount = $vehicle->count(); 
        return view('agent.dashboard', [
            'user' => $user,
            'userDetails' => $userDetails,
            'vehicle' => $vehicle,
            'getaddvehicle' => $getaddvehicle,
            'vehicleCount' => $vehicleCount,
            'totalWalletAmount' => $totalWalletAmount
        ]);
    }

    public function pricing(){
        $data['user'] = Auth::guard('agent')->user();
        $data['vehiclelist'] =  VehicleType::all();
        $data['vehiclecategories'] = VehicleRegistrationType::all();
        $data['states'] = State::all();
        $data['otherPermits'] = OtherPermitPrice::all();
          
        return view('agent.pages.pricing', $data);
    }

    public function handleStateSelection(Request $request)
    {
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        $stateId = $request->input('stateId');
        $addVehiclerenewal = AddVehicleRenewal::where('user_id', $userId)
                                            ->where('user_email', $userEmail)
                                            ->where('userType', 'agent')->get();

        $vehicleCategories = $addVehiclerenewal->pluck('category')->unique();
        $stateVehicleList = collect();
        foreach ($vehicleCategories as $category) { 
            $results = VehicleRenewalPrice::with(['vehicleType', 'stateInfo'])
                ->where('state_id', $stateId)
                ->where('vehicleType_id', $category)
                ->get();
            
            $stateVehicleList = $stateVehicleList->merge($results); 
        }

        return response()->json([
            'success' => true,
            'message' => 'State ID received successfully',
            'stateId' => $stateId,
            'addVehiclerenewal' => $addVehiclerenewal,
            'vehicleCategories' => $vehicleCategories,
            'stateVehicleList' => $stateVehicleList,
        ]);
    }

    public function handleUserSelection() 
    {
        $user = Auth::guard('agent')->user();

        $userList = AddVehicleRenewal::where('userType', 'agent')
        ->where('user_id', $user->id)
        ->get();

        return response()->json([
            'userList' => $userList,
            'userId' => $user->id, 
        ]);
    }

    public function processHistory()
    {
        $user = Auth::guard('agent')->user();
        $id = $user->id;
        $email = $user->email;

        $processhistory = ProcessHistory::where('user_id', $id)
                                        ->where('user_email', $email)
                                        ->where('userType', 'agent')
                                        ->latest()
                                        ->get();

        return view('agent.pages.processhistory', compact('id', 'email', 'processhistory','user'));
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
        $user = Auth::guard('agent')->user();
        $id = $user->id;
        $email = $user->email;

        $transactionhistory = ProcessHistory::where('user_id', $id)
                                            ->where('userType', $email)
                                            ->where('userType', 'agent')
                                            ->get();

        return view('agent.pages.transactionhistory', compact('user','id', 'email', 'transactionhistory'));
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
        $user = Auth::guard('agent')->user();
        $id = $user->id;
        $email = $user->email;
        $faqs = FAQs::all();

       return view('agent.pages.faq', compact('id', 'email','user','faqs'));
    }


}
