<?php

namespace App\Http\Controllers\Agent\AddVehicle;
use Carbon\Carbon;
use Auth; 
use Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\AddVehicleRegistration;
use App\Services\AddVehicleRegistrationService; 
use App\Models\VehicleRegistrationType; 
use App\Models\VehicleRegistrationPrice; 
use App\Models\VehicleRegistration;
  

class AddVehicleRegistrationController extends Controller
{
    
    public function index()
    {                     
        $data['user'] = Auth::guard('agent')->user();
        return view('agent.pages.process.newVehicleRegistration',$data);
    }

    public function handleOwnerSelection() 
    {
        $user = Auth::guard('agent')->user();

        $userList = AddVehicleRegistration::where('userType', 'agent')
        ->where('user_id', $user->id)
        ->get();

        return response()->json([
            'userList' => $userList,
            'userId' => $user->id,
        ]);
    }

    public function getUserAddVehiclesRegistration()
    {
        $user = Auth::guard('agent')->user();
        $id = $user->id;
        $userEmail = $user->email;
        $states = State::all();

        $vehicleCount = AddVehicleRegistration::where('user_id', $id)
                                            ->where('user_email', $userEmail)
                                            ->where('userType', 'agent')->count();
        $vehicleList  = AddVehicleRegistration::where('user_id', $id)
                                            ->where('user_email', $userEmail)
                                            ->where('userType', 'agent')->get();

        $vehicleResType = VehicleRegistrationType::all();

        return response()->json([
            'vehicleCount' => $vehicleCount,
            'vehicleList' => $vehicleList,
            'stateList' => $states,
            'vehicleResType' => $vehicleResType
        ]);
    }

    public function handleOwnerVehicleSelection(Request $request)
    {
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        $ownerId = $request->input('ownerId');
        $stateId = $request->input('stateId');

        $addVehicleregistration = AddVehicleRegistration::where('user_id', $userId)
                                            ->where('user_email', $userEmail)
                                            ->where('id', $ownerId)
                                            ->where('userType', 'agent')->get();

        $vehicleCategories = $addVehicleregistration->pluck('category')->unique();
        $stateVehicleList = collect();
        foreach ($vehicleCategories as $category) { 
            $results = VehicleRegistrationPrice::with(['vehicleType', 'stateInfo'])
                ->where('state_id', $stateId) 
                ->where('vehicle_type_id', $category)
                ->get();
            
            $stateVehicleList = $stateVehicleList->merge($results); 
        }

        return response()->json([
            'success' => true,
            'message' => 'State ID received successfully',
            'stateId' => $stateId,
            'stateVehicleList' => $stateVehicleList,

        ]);
    }

    public function handleOwnerVehicleSelectionn(Request $request)
    {
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        $stateId = $request->input('stateId');
        $ownerId = $request->input('ownerId');

        $addVehiclerenewal = AddVehicleRegistration::where('user_id', $userId)
                                            ->where('user_email', $userEmail)
                                            ->where('id', $ownerId)
                                            ->where('userType', 'agent')->get();

        $vehicleCategories = $addVehiclerenewal->pluck('category')->unique();
        $stateVehicleList = collect();
        foreach ($vehicleCategories as $category) { 
            $results = VehicleRegistrationPrice::with(['vehicleType', 'stateInfo'])
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

    public function handleVehicleCategoryIdSelection(Request $request){
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $stateId = $request->input('stateId');

        $vehicleList = AddVehicleRegistration::where('user_id', $userId)
                                            ->where('category', $vehicleCategoryId)
                                            ->where('user_email', $userEmail)
                                            ->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Vehicle ID received successfully',
            'vehicleList' => $vehicleList,
        ]);
    }

    public function handleVehicleRegCost(Request $request)
    {
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;

        $vehicleRegCategoryId = $request->input('vehicleCategoryId');
        $stateId = $request->input('stateId');
        $plateType = $request->input('plateType');
        $registrationTypeId = $request->input('vehicleResType');

        $numberTypeId = $plateType;
        $vehiclename = VehicleType::find($vehicleRegCategoryId);
        $vehicleRegPrice = VehicleRegistrationPrice::where('state_id', $stateId)
                                                ->where('vehicle_type_id', $vehicleRegCategoryId)
                                                ->get();
        
        if ($vehicleRegPrice->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No vehicle registration price found for the selected state and vehicle category.'
            ], 404);
        }

        $vehiclecategories = VehicleRegistrationType::find($registrationTypeId);
        $vehiclename2 = VehicleType::find($vehicleRegPrice->first()->vehicle_type_id);

        $amount = 0;
        $HackneyPermit = 0;
        $PoliceCmris = 0;

        if ($vehiclecategories && strpos($vehiclename->name, $vehiclename2->name) !== false) {
            if ($numberTypeId == 'RPN') {
                $RPrivateVehicle3rdPartyInsurance = $vehicleRegPrice->first()->random_private_vehicle_3rd_party_insurance ?? 0;
                $RPrivateVehicle3rdPartyNoInsurance = $vehicleRegPrice->first()->random_plate_private_vehicle_no_insurance ?? 0;
                $RCommercialPlate3rdPartyInsurance = $vehicleRegPrice->first()->random_commercial_plate_3rd_party_insurance ?? 0;
                $RCommercialPlate3rdPartyNoInsurance = $vehicleRegPrice->first()->random_plate_no_commercial_vehicle_no_insurance ?? 0;
                $HackneyPermit =  $vehicleRegPrice->first()->random_plate_hackney_permit ?? 0;
                $PoliceCmris =  $vehicleRegPrice->first()->random_plate_police_cmris ?? 0;
               
                switch ($vehiclecategories->name) {
                    case 'Private Vehicle With 3rd/P insurance':
                        $amount = $RPrivateVehicle3rdPartyInsurance;
                        break;
                    case 'Private Vehicle With No insurance':
                        $amount = $RPrivateVehicle3rdPartyNoInsurance;
                        break;
                    case 'Commercial Vehicle With 3rd/P insurance':
                        $amount = $RCommercialPlate3rdPartyInsurance;
                        break;
                    case 'Commercial Vehicle No insurance':
                        $amount = $RCommercialPlate3rdPartyNoInsurance;
                        break;
                }
            } elseif ($numberTypeId == 'PCN') { 
                $CPrivateVehicle3rdPartyInsurance = $vehicleRegPrice->first()->customized_private_vehicle_3rd_party_insurance ?? 0;
                $CPrivateVehicle3rdPartyNoInsurance = $vehicleRegPrice->first()->customised_plate_private_vehicle_no_insurance ?? 0;
                $CCommercialPlate3rdPartyInsurance = $vehicleRegPrice->first()->customised_commercial_plate_3rd_party_insurance ?? 0;
                $CCommercialPlate3rdPartyNoInsurance = $vehicleRegPrice->first()->customized_plate_no_commercial_vehicle_no_insurance ?? 0;
                $HackneyPermit =  $vehicleRegPrice->first()->customized_plate_hackney_permit ?? 0;
                $PoliceCmris =  $vehicleRegPrice->first()->customised_plate_police_cmris ?? 0;
               
                switch ($vehiclecategories->name) {
                    case 'Private Vehicle With 3rd/P insurance':
                        $amount = $CPrivateVehicle3rdPartyInsurance;
                        break;
                    case 'Private Vehicle With No insurance':
                        $amount = $CPrivateVehicle3rdPartyNoInsurance;
                        break;
                    case 'Commercial Vehicle With 3rd/P insurance':
                        $amount = $CCommercialPlate3rdPartyInsurance;
                        break;
                    case 'Commercial Vehicle No insurance':
                        $amount = $CCommercialPlate3rdPartyNoInsurance;
                        break;
                }
            }
        } 

        return response()->json([
            'success' => true,
            'message' => 'Vehicle cost retrieved successfully',
            'hackneyPermitCost' => $HackneyPermit,
            'policeCmrisCost' => $PoliceCmris,
            'amount' => $amount,
        ]);
    }


    public function postNewVehicleRegistration(Request $request){
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;

        $stateId = $request->input('stateId');
        $userType = $request->input('userType');
        $ownerId = $request->input('ownerId');
        $vehicleRegCategoryId = $request->input('vehicleRegCategoryId');
        $vehicleResType = $request->input('vehicleResType');
        $addVehicleReg = $request->input('addVehicleReg');
        $hackneyPermitTotal = $request->input('hackneyPermitTotal');
        $policeCMRISTotal = $request->input('policeCMRISTotal');
        $preferredNumber = $request->input('preferredNumber');
        $plateNumberType = $request->input('plateNumberType');
        $totalAmount = $request->input('totalAmount');

        $randomNumber = mt_rand(100000, 999999);
        $processId = 'PRONVR' . $randomNumber;
        try{
            $registration = VehicleRegistration::create([
                'user_id' => $userId,
                'user_email' => $userEmail,
                'owner_id' => $ownerId,
                'userType' => 'agent',
                'process_id' => $processId,
                'process_type' => 'Vehicle Registration',
                'category' => $vehicleRegCategoryId,
                'registrationType' => $vehicleResType,
                'plateNumberType' => $plateNumberType,
                'preferredNumber' => $preferredNumber,
                'hackneyPermit' => $hackneyPermitTotal,
                'policeCMRIS' => $policeCMRISTotal,
                'payment_status' => 'pending',
                'totalamount' => $totalAmount,
            ]);
            // Add the registration to the shopping cart
            Cart::add([
                'id' => $registration->id,
                'name' => $registration->process_type,
                'price' => $registration->totalamount,
                'qty' => 1,
                'attributes' => [
                    'process_id' => $registration->process_id,
                    'process_type' => $registration->process_type,
                    'vcategory' => $registration->category,
                    'process_details' => $registration->registrationType,
                    'plateNumberType' => $registration->plateNumberType,
                    'preferredNumber' => $registration->preferredNumber,
                ]
            ])->associate('App\Models\VehicleRegistration');
            
            return response()->json([
                'success' => true,
                'message' => "New Vehicle Registration has been added to Cart Successfully",
                "registration" =>$registration
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => true,
                'Exception' => $e,
            ]);
        }
    }
}
