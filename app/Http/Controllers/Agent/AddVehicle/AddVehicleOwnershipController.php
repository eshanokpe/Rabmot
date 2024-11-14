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
use App\Models\AddVehicleOwnership;
use App\Services\AddVehicleOwnershipService; 
use App\Models\VehicleRegistrationType; 
use App\Models\ChangeOfOwnership; 
use App\Models\ChangeofOwnershipPrice; 



class AddVehicleOwnershipController extends Controller
{
   
    public function index()
    {
        $user = Auth::guard('agent')->user();
        $id = $user->id;
        $email = $user->email;

        $state = State::all();
        $vehicleCount = AddVehicleOwnership::where('user_id', $id )
                                            ->where('user_email', $email)
                                            ->where('userType', 'agent')
                                            ->get()->count();
        $vehicleList = AddVehicleOwnership::where('user_id', '=', $id) 
                                            ->where('user_email', $email)
                                            ->where('userType', 'agent')
                                            ->get();
        
        $vehicleitem = VehicleType::where('id', $id)->get();
        
        return view('agent.pages.process.changeofownership', compact('user','email', 'id', 'vehicleList', 'vehicleitem', 'vehicleCount', 'state'));
    }

    public function handleOwnerSelection() 
    {
        $user = Auth::guard('agent')->user();

        $userList = AddVehicleOwnership::where('userType', 'agent')
        ->where('user_id', $user->id)
        ->get();

        return response()->json([
            'userList' => $userList,
            'userId' => $user->id,
        ]);
    }

    public function getUserAddVehiclesOwnership()
    {
        $user = Auth::guard('agent')->user();
        $id = $user->id;
        $userEmail = $user->email;

        $states = State::all();
        $vehicleCount = AddVehicleOwnership::where('user_id', $id )
                                            ->where('user_email', $userEmail)
                                            ->where('userType', 'agent')
                                            ->get()->count();
        $vehicleList = AddVehicleOwnership::where('user_id', $id)
                                            ->where('user_email', $userEmail)
                                            ->where('userType', 'agent')
                                            ->get();
        
        return response()->json([
            'vehicleCount' => $vehicleCount,
            'vehicleList' => $vehicleList,
            'stateList' => $states,
        ]);
    }

    public function handleOwnerVehicleSelection(Request $request)
    {
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        $ownerId = $request->input('ownerId');
        $stateId = $request->input('stateId');
        $addVehicleregistration = AddVehicleOwnership::where('user_id', $userId)
                                                        ->where('user_email', $userEmail)
                                                        ->where('id', $ownerId)
                                                        ->where('userType', 'agent')
                                                        ->get();

        $vehicleCategories = $addVehicleregistration->pluck('category')->unique();
        $stateVehicleList = collect();
        foreach ($vehicleCategories as $category) { 
            $results = ChangeofOwnershipPrice::with(['vehicleType', 'stateInfo'])
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

    public function handleVehicleCategoryIdSelection(Request $request){
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $stateId = $request->input('stateId');

        $vehicleList = AddVehicleOwnership::where('user_id', $userId)
                                            ->where('category', $vehicleCategoryId)
                                            ->where('user_email', $userEmail)
                                            ->get();
                      
        return response()->json([
            'success' => true,
            'message' => 'Vehicle ID received successfully',
            'vehicleList' => $vehicleList,
        ]);
    }

    public function handleVehicleOwnershipCost(Request $request){
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        $stateId = $request->input('stateId');
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $vehicleAddOwnershipCategory = $request->input('vehicleCategoryId');
        $addVehicleOwnership = $request->input('addVehicleOwnership');
        $vLExpirydate = $request->input('vLExpirydate');
        $hackneyPermit = $request->input('hackneyPermit');
        $platenumber = $request->input('plateType');
        
        $vehiclename = VehicleType::where('id', $vehicleAddOwnershipCategory )->first();
        $changeofownershipPrice = ChangeofOwnershipPrice::where('state_id', $stateId)
                                                        ->where('vehicle_type_id', $vehicleCategoryId)->get();
        $vehicleCost = 0;
        $RVLAmount = 0;
        $policeCMRIS = 0;
        $RHPermitAmount = 0;
        $vehiclelicenseAmount = 0;
        $hackneyPermitCost = 0;
        
        if(strpos($vehiclename->name, $vehiclename->name) !== false && $platenumber == 'RPN' && $addVehicleOwnership  || $hackneyPermit){
            $vehicleCost =  $changeofownershipPrice->first()->random_cost;
            $RVLAmount =  $changeofownershipPrice->first()->random_vehicleLicense;
            $RHPermitAmount =  $changeofownershipPrice->first()->random_hacneyPermit;
            $policeCMRIS =  $changeofownershipPrice->first()->random_policeCmris;
            
            switch($vLExpirydate){
                case 'lessthan1month':
                    $vehiclelicenseAmount = 0;
                    break;
                case 'morethan1month':
                    $vehiclelicenseAmount = $RVLAmount;
                    break;
                case 'morethan1year':
                    $vehiclelicenseAmount = $RVLAmount * 2;
                    break;
                case 'morethan2year':
                    $vehiclelicenseAmount = $RVLAmount * 3;
                    break;
                case 'morethan3year':
                    $vehiclelicenseAmount = $RVLAmount * 4;
                    break;
                case 'morethan4year':
                    $vehiclelicenseAmount = $RVLAmount * 5;
                    break;
                case 'morethan5year':
                    $vehiclelicenseAmount = $RVLAmount * 6;
                    break;
                case 'morethan6year':
                    $vehiclelicenseAmount = $RVLAmount * 7;
                    break;
                case 'morethan7year':
                    $vehiclelicenseAmount = $RVLAmount * 8;
                    break;
                default:
                    $vehiclelicenseAmount = 0;
            }
            switch($hackneyPermit){
                case 'lessthan1month':
                    $hackneyPermitCost = 0;
                    break;
                case 'morethan1month':
                    $hackneyPermitCost = $RHPermitAmount;
                    break;
                case 'morethan1year':
                    $hackneyPermitCost = $RHPermitAmount * 2;
                    break;
                case 'morethan2year':
                    $hackneyPermitCost = $RHPermitAmount * 3;
                    break;
                case 'morethan3year':
                    $hackneyPermitCost = $RHPermitAmount * 4;
                    break;
                case 'morethan4year':
                    $hackneyPermitCost = $RHPermitAmount * 5;
                    break;
                case 'morethan5year':
                    $hackneyPermitCost = $RHPermitAmount * 6;
                    break;
                case 'morethan6year':
                    $hackneyPermitCost = $RHPermitAmount * 7;
                    break;
                case 'morethan7year':
                    $hackneyPermitCost = $RHPermitAmount * 8;
                    break;
                default:
                    $hackneyPermitCost = 0;
            }
        } elseif(strpos($vehiclename->name, $vehiclename->name) !== false && $platenumber == 'CPN' && $addVehicleOwnership || $hackneyPermit){
            $vehicleCost =  $changeofownershipPrice->first()->customised_cost;
            $CVLAmount =  $changeofownershipPrice->first()->customised_vehicleLicense;
            $CHPermitAmount =  $changeofownershipPrice->first()->customised_hacneyPermit;
            $policeCMRIS =  $changeofownershipPrice->first()->customised_policeCmris;
            switch($vLExpirydate){
                case 'lessthan1month':
                    $vehiclelicenseAmount = 0;
                    break;
                case 'morethan1month':
                    $vehiclelicenseAmount = $CVLAmount;
                    break;
                case 'morethan1year':
                    $vehiclelicenseAmount = $CVLAmount * 2;
                    break;
                case 'morethan2year':
                    $vehiclelicenseAmount = $CVLAmount * 3;
                    break;
                case 'morethan3year':
                    $vehiclelicenseAmount = $CVLAmount * 4;
                    break;
                case 'morethan4year':
                    $vehiclelicenseAmount = $CVLAmount * 5;
                    break;
                case 'morethan5year':
                    $vehiclelicenseAmount = $CVLAmount * 6;
                    break;
                case 'morethan6year':
                    $vehiclelicenseAmount = $CVLAmount * 7;
                    break;
                case 'morethan7year':
                    $vehiclelicenseAmount = $CVLAmount * 8;
                    break;
                default:
                    $vehiclelicenseAmount = 0;
            }
            switch($hackneyPermit){
                case 'lessthan1month':
                    $hackneyPermitCost = "0";
                    break;
                case 'morethan1month':
                    $hackneyPermitCost = $CHPermitAmount;
                    break;
                case 'morethan1year':
                    $hackneyPermitCost = $CHPermitAmount * 2;
                    break;
                case 'morethan2year':
                    $hackneyPermitCost = $CHPermitAmount * 3;
                    break;
                case 'morethan3year':
                    $hackneyPermitCost = $CHPermitAmount * 4;
                    break;
                case 'morethan4year':
                    $hackneyPermitCost = $CHPermitAmount * 5;
                    break;
                case 'morethan5year':
                    $hackneyPermitCost = $CHPermitAmount * 6;
                    break;
                case 'morethan6year':
                    $hackneyPermitCost = $CHPermitAmount * 7;
                    break;
                case 'morethan7year':
                    $hackneyPermitCost = $CHPermitAmount * 8;
                    break;
                default:
                    $hackneyPermitCost = "0";
            }
        }else{
            $vehiclelicenseAmount = 0;
            $hackneyPermitCost = 0;
            $vehicleCost = 0;
        }
         
        return response()->json([
            'success' => true,
            'platenumber' => $platenumber,
            'message' => 'Vehicle Ownershipt Cost',
            'vehicleCost' => $vehicleCost,
            'hackneyPermitCost' => $hackneyPermitCost,
            'vehicleLicenseCost' => $vehiclelicenseAmount,
            'addVehicleOwnership' => $addVehicleOwnership,
            'platenumber' => $platenumber,
            'policeCMRISCost' => $policeCMRIS,
        ]);
    }

    public function postChangeOfVehicleOwnership(Request $request){
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail = $user->email;

        $stateId = $request->input('stateId');
        $ownerId = $request->input('ownerId');
        $userType = $request->input('userType');
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $addVehicleOwnership = $request->input('addVehicleOwnership');
        $vLExpirydate = $request->input('vLExpirydate');
        $hackneyPermit = $request->input('hackneyPermit');
        $plateType = $request->input('plateType');
        $policeCMRISTotal = $request->input('policeCMRISTotal');

        $totalAmount = $request->input('totalAmount');

        $randomNumber = mt_rand(100000, 999999);
        $processId = 'PROCO' . $randomNumber;
        $vehicleitem = VehicleType::where('id', $vehicleCategoryId)->first();
        $vehicleType = $vehicleitem->name;

        ChangeOfOwnership::create([
            'user_id' => $userId,
            'owner_id' => $ownerId,
            'user_email' => $userEmail,
            'userType' => $userType,
            'process_id' => $processId,
            'process_type' => 'Change of Ownership',
            'vehicle_category' => $vehicleType,
            'vehiclelicenseexpiry_date' => $vLExpirydate,
            'vehiclelicenseexpiry' => $vLExpirydate,
            'hackneypermitexpiry' => $hackneyPermit, 
            'platenumber' => $plateType,
            'policeCMRIS' => $policeCMRISTotal,
            'payment_status' => 0.00,
            'totalamount' => $totalAmount,
        ]);
        $users = ChangeOfOwnership::where('process_id', $processId)->first();
        Cart::add([
            'id' => $users->id,
            'name' => $users->process_type,
            'price' => $users->totalamount,
            'qty' => 1,
            'options' => array(
                'process_id' => $users->process_id,
                'process_type' => $users->process_type,
                'process_detials' => $vehicleitem->name,
                'vehiclelicenseexpiry_date' => $vehicleitem->vehiclelicenseexpiry_date,
                'insuranceexpiry' => $vehicleitem->insuranceexpiry,
                'roadworthinessexpiry' => $vehicleitem->roadworthinessexpiry,
                'hackneypermitexpiry' => $vehicleitem->hackneypermitexpiry,
            )
        ])->associate('App\Models\ChangeOfOwnership');

        return response()->json([
            'success' => true,
            'message' => "New Change of Ownership has been added to Cart Successfully",
            'vehicleType' => $vehicleType
        ]);

    }
    
}
