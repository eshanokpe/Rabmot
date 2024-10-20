<?php


namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AddVehicleRenewal;
use App\Models\WalletPayment;

use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('agent')->user();
        dd($user);
        $userId = $user->id;
        $userEmail = $user->email;

        $userDetails = User::where('id', $user->id)->first();
        // $userDetails = User::where('id', $user->id)->with('agentDetails')->first();
        $totalWalletAmount = WalletPayment::where('user_id', $userId)
        ->where('userType', 'agent')
        ->where('user_email', $userEmail)->sum('amount');
        $getaddvehicle = AddVehicleRenewal::with('categoryInfo')
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

}
