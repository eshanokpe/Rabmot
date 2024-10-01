<?php

namespace App\Http\Controllers\User\AddVehicle;
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
    protected $addVehicleOwnershipService;

    public function __construct(AddVehicleOwnershipService $addVehicleOwnershipService)
    {
        $this->addVehicleOwnershipService = $addVehicleOwnershipService;
    }

    public function index()
    {
        $id = Auth::user()->id;
        $vehicleList = VehicleType::all();

        return view('user.pages.addVehicle.addVehicleOwnership', compact('vehicleList'));
    }



    public function postAddvehicleOwnership(Request $request){
       
        $this->validateRequest($request); 

        try {
            $this->addVehicleOwnershipService->handleRegistration($request);
            return redirect()->route('home.changeofOwnership')->withSuccess('New Vehicle Ownership has been created Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'vehiclemake' => 'required',
            'vehiclemodel' => 'required',
            'platenumber' => 'required',
            'vehiclecolor' => 'required',
            'vehiclepapername' => 'required',
           
            'ownerfullname' => 'required',
            'address' => 'required',
            'phonenumber' => 'required',
            'emailaddress' => 'required',
            'gender' => 'required',

            'vehiclelicensepapers' => 'mimes:jpeg,docx,doc,jpg,png|max:2024', 
            'insuranceexpiry.required' => '|mimes:jpeg,docx,doc,jpg,png|max:2024',
            'roadworthinessexpiry.required' => 'mimes:jpeg,docx,doc,jpg,png|max:2024',
            'statecarriagepermitexpiry.required' => 'mimes:jpeg,docx,doc,jpg,png|max:2024',          
        ],[
            'category.required' => 'The Category is required',
            'vehiclemake.required' => 'The Vehicle Mmake is required',
            'vehiclemodel.required' => 'The Vehicle Model is required',
            'platenumber.required' => 'The Plate Number is required',
            'vehiclecolor.required' => 'The Vehicle Color is required',
            'vehiclepapername.required' => 'The Vehicle Paper is required',
            
            'ownerfullname.required' => 'The Owner Fullname is required',
            'address.required' => 'The Address is required',
            'phonenumber.required' => 'The Phone Number is required',
            'emailaddress.required' => 'The Email Adress is required',
            'gender.required' => 'The Gender is required',
          
            'vehiclelicensepapers.mimes' => 'Please upload the correct file format.',
            'proofofownership.mimes' => 'Please upload the correct file format.',
            'agreement.mimes' => 'Please upload the correct file format.',
            'meansofid.mimes' => 'Please upload the correct file format.',

            'vehiclelicensepapers.required' => 'The Vehiclelicense Papers is required.',
            'proofofownership.required' => 'The Proof of ownership is required.',
            'agreement.required' => 'The Agreement is required.',
            'meansofid.required' => 'The Means of ID is required.',
        ]);
    }

    public function ChangeofOwnership()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $state = State::all();
        $vehicleCount = AddVehicleOwnership::where('user_id', $id )->get()->count();
        $vehicleList = AddVehicleOwnership::where('user_id', '=', $id)->get();
        
        $vehicleitem = VehicleType::where('id', $id)->get();
        
        return view('user.pages.process.changeofownership', compact('email', 'id', 'vehicleList', 'vehicleitem', 'vehicleCount', 'state'));
    }

    public function getUserAddVehiclesOwnership()
    {
        $user = Auth::user();
        $id = $user->id;
        $states = State::all();
        $vehicleCount = AddVehicleOwnership::where('user_id', $id)->count();
        $vehicleList = AddVehicleOwnership::where('user_id', $id)->get();
        
        return response()->json([
            'vehicleCount' => $vehicleCount,
            'vehicleList' => $vehicleList,
            'stateList' => $states,
        ]);
    }

    public function handleStateSelection(Request $request)
    {
        $userId = Auth::id();
        $stateId = $request->input('stateId');
        $addVehicleregistration = AddVehicleOwnership::where('user_id', $userId)->get();

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
        $userId = Auth::id();
        $userEmail = Auth::user()->email;
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
        $userId = Auth::id();
        $userEmail = Auth::user()->email;
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
        $userId = Auth::id();
        $userEmail = Auth::user()->email;
        $stateId = $request->input('stateId');
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
            'user_email' => $userEmail,
            'userType' => $userType,
            'process_id' => $processId,
            'process_type' => 'Change of Ownership',
            'vehicle_category' => $vehicleType,
            'vehiclelicenseexpiry_date' => $vLExpirydate,
            'hacneypermit' => $hackneyPermit,
            'platenumber' => $plateType,

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
