<?php

namespace App\Http\Controllers\Agent\AddVehicle;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Models\AddVehicleRenewal;
use App\Models\VehicleType;
use App\Models\VehicleRenewalPrice;
use App\Models\VehiclePaperRenewal;
use Cart;
use App\Http\Requests\AddVehicleRenewalRequest;
use App\Services\AddVehicleRenewalService;

class AddVehicleRenewalController extends Controller
{
    
    public function  index(){ 
        $data['user'] = Auth::guard('agent')->user();
        return view('agent.pages.process.vehicleRenewalPaper', $data);
    }

    // VehicleRenewalController.php
    public function getUserAddVehiclesRenewal(Request $request)
    { 
        $user = Auth::guard('agent')->user();
        $id = $user->id;
        $userEmail = $user->email;
        $states = State::all();

        $ownerVehicleRenewal = $request->input('ownerVehicleRenewal');
        // $ownerUserId = $request->input('ownerUserId');

        $vehicleCount = AddVehicleRenewal::where('id', $id)
                                        ->where('user_email', $userEmail)
                                        ->where('userType', 'agent')->count();

        $vehicleList = AddVehicleRenewal::where('id', $id)
                                        ->where('user_email', $userEmail)
                                        ->where('userType', 'agent')->get();
       
        return response()->json([
            'vehicleCount' => $vehicleCount,
            'vehicleList' => $vehicleList,
            'stateList' => $states,
            'id'=> $id,
            'ownerId'=> $ownerId,
            'ownerVehicleRenewal' => $ownerVehicleRenewal
        ]);
    } 

    public function handleVehicleCategoryIdSelection(Request $request){
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $stateId = $request->input('stateId');

        $vehicleList = AddVehicleRenewal::where('user_id', $userId)
                                            ->where('category', $vehicleCategoryId)
                                            ->where('user_email', $userEmail)
                                            ->where('userType', 'agent')
                                            ->get();

                      
        return response()->json([
            'success' => true,
            'message' => 'Vehicle ID received successfully',
            'vehicleList' => $vehicleList,
           
        ]);
    }

    public function handleAddVehicleValueSelection(Request $request){
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $stateId = $request->input('stateId');
        $addVehicleValue = $request->input('addVehicleValue');

        $vehicleRenewalPrice = VehicleRenewalPrice::with(['vehicleType', 'stateInfo'])
                                            ->where('state_id', $stateId)
                                            ->where('vehicleType_id', $vehicleCategoryId)
                                            ->first();
                      
        return response()->json([
            'success' => true,
            'message' => 'Vehicle Renewal successfully',
            'vehicleLicenseCost' => $vehicleRenewalPrice->vehicle_license,
            'roadWorthinessCost' => $vehicleRenewalPrice->road_worthiness,
            'thirdPartyInsuranceCost' => $vehicleRenewalPrice->third_party_insurance,
            'proofOfOwnershipCost' => $vehicleRenewalPrice->proof_of_ownership,
            'hackneyPermitCost' => $vehicleRenewalPrice->hackney_permit,
            'vehicleInspectionPickanddropCost' => $vehicleRenewalPrice->vehicle_inspection_pickanddrop,
            'policeCmrisCost' => $vehicleRenewalPrice->police_cmris,
        ]);
    }

    public function handlePostVehicleRenewal(Request $request){
        try{
            $user = Auth::guard('agent')->user();
            $userId = $user->id;
            $userEmail = $user->email;
            $userType = $request->input('userType');
            $stateId = $request->input('stateId');
            $ownerId = $request->input('userId');
            $vehicleCategoryId = $request->input('vehicleCategoryId');
            $addVehicleRenewal = $request->input('addVehicleRenewal');
            $vehicleLicenseTotal = $request->input('vehicleLicenseTotal');
            $roadWorthinessTotal = $request->input('roadWorthinessTotal');
            $thirdPartyInsuranceTotal = $request->input('thirdPartyInsuranceTotal');
            $proofOfOwnershipTotal = $request->input('proofOfOwnershipTotal');
            $hackneyPermitTotal = $request->input('hackneyPermitTotal');
            $vehicleInspectionPickanddropTotal = $request->input('vehicleInspectionPickanddropTotal');
            $policeCMRISTotal = $request->input('policeCMRISTotal');
            $totalAmount = $request->input('totalAmount');

            $randomNumber = mt_rand(100000, 999999);
            $processId = 'PROVPR' . $randomNumber;

            $vehicleitem = VehicleType::where('id', $vehicleCategoryId)->first();
            $vehicleType = $vehicleitem->name;

            // Save the data
            VehiclePaperRenewal::create([ 
                'user_id' => $userId,
                'user_email' => $userEmail,
                'owner_id' => $ownerId,
                'userType' => $userType,
                'process_id' => $processId,
                'process_type' => 'Vehicle Paper Renewal',
                'vehicleCategory' => $vehicleCategoryId,
                'vehicleType' => $vehicleType,
                'vehicleLicense' => $vehicleLicenseTotal,
                'roadWorthiness' => $roadWorthinessTotal,
                'proofOfOwnership' => $proofOfOwnershipTotal,
                'thirdPartyInsurance' => $thirdPartyInsuranceTotal,
                'hackneyPermit' => $hackneyPermitTotal,
                'policeCMRIS' => $policeCMRISTotal,
                'vehicleInspectionPickanddrop' => $vehicleInspectionPickanddropTotal,
                'payment_status' => 'pending',
                'totalamount' => $totalAmount,
            ]);

            $users = VehiclePaperRenewal::where('process_id', $processId)->first();
        
            $vehicleitem = VehicleType::where('id', $userId)->first();
            Cart::add([
                'id' => $users->id,
                'name' => $users->process_type,
                'price' => $users->totalamount,
                'qty' => 1, 
                'options' => array(
                    'process_id' => $users->process_id,
                    'process_type' => $users->process_type,
                    'process_detials' => $users->name,
                )
            ])->associate('App\Models\VehiclePaperRenewal');
            
            return response()->json([
                'success' => true,
                'message' => 'Post VehicleRenewal',
                'vehicleType' => $vehicleType,
                'processId' => $processId,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'Exception' => $e,
            ]);
        }
    }

        

    



 
}
