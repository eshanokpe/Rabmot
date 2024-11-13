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

    public function handleVehicleOwnershipCost(Request $request)
    {
        $userId = Auth::id();
        $userEmail = Auth::user()->email;
        $stateId = $request->input('stateId');
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $vehicleAddOwnershipCategory = $request->input('vehicleCategoryId');
        $addVehicleOwnership = $request->input('addVehicleOwnership');
        $vLExpirydate = $request->input('vLExpirydate');
        $hackneyPermit = $request->input('hackneyPermit');
        $platenumber = $request->input('plateType');
        
        $vehiclename = VehicleType::where('id', $vehicleAddOwnershipCategory)->first();
        $changeofownershipPrice = ChangeofOwnershipPrice::where('state_id', $stateId)
                                                        ->where('vehicle_type_id', $vehicleCategoryId)
                                                        ->first();

        // Initialize variables
        $vehicleCost = 0;
        $RVLAmount = 0;
        $policeCMRIS = 0;
        $RHPermitAmount = 0;
        $vehiclelicenseAmount = 0;
        $hackneyPermitCost = 0;

        if (
            strpos($vehiclename->name, $vehiclename->name) !== false &&
            $platenumber == 'RPN' && 
            ($addVehicleOwnership || $hackneyPermit)
        ) {
            // Regular plate number
            $vehicleCost = $changeofownershipPrice->random_cost;
            $RVLAmount = $changeofownershipPrice->random_vehicleLicense;
            $RHPermitAmount = $changeofownershipPrice->random_hacneyPermit;
            $policeCMRIS = $changeofownershipPrice->random_policeCmris;

            // Calculate vehicle license amount based on expiry date
            $vehiclelicenseAmount = match ($vLExpirydate) {
                'lessthan1month' => 0,
                'morethan1month' => $RVLAmount,
                'morethan1year' => $RVLAmount * 2,
                'morethan2year' => $RVLAmount * 3,
                'morethan3year' => $RVLAmount * 4,
                'morethan4year' => $RVLAmount * 5,
                'morethan5year' => $RVLAmount * 6,
                'morethan6year' => $RVLAmount * 7,
                'morethan7year' => $RVLAmount * 8,
                default => 0
            };

            // Calculate hackney permit cost
            $hackneyPermitCost = match ($hackneyPermit) {
                'lessthan1month' => 0,
                'morethan1month' => $RHPermitAmount,
                'morethan1year' => $RHPermitAmount * 2,
                'morethan2year' => $RHPermitAmount * 3,
                'morethan3year' => $RHPermitAmount * 4,
                'morethan4year' => $RHPermitAmount * 5,
                'morethan5year' => $RHPermitAmount * 6,
                'morethan6year' => $RHPermitAmount * 7,
                'morethan7year' => $RHPermitAmount * 8,
                default => 0
            };
        } elseif (
            strpos($vehiclename->name, $vehiclename->name) !== false &&
            $platenumber == 'CPN' && 
            ($addVehicleOwnership || $hackneyPermit)
        ) {
            // Customised plate number
            $vehicleCost = $changeofownershipPrice->customised_cost;
            $CVLAmount = $changeofownershipPrice->customised_vehicleLicense;
            $CHPermitAmount = $changeofownershipPrice->customised_hacneyPermit;
            $policeCMRIS = $changeofownershipPrice->customised_policeCmris;

            // Calculate vehicle license amount based on expiry date
            $vehiclelicenseAmount = match ($vLExpirydate) {
                'lessthan1month' => 0,
                'morethan1month' => $CVLAmount,
                'morethan1year' => $CVLAmount * 2,
                'morethan2year' => $CVLAmount * 3,
                'morethan3year' => $CVLAmount * 4,
                'morethan4year' => $CVLAmount * 5,
                'morethan5year' => $CVLAmount * 6,
                'morethan6year' => $CVLAmount * 7,
                'morethan7year' => $CVLAmount * 8,
                default => 0
            };

            // Calculate hackney permit cost
            $hackneyPermitCost = match ($hackneyPermit) {
                'lessthan1month' => 0,
                'morethan1month' => $CHPermitAmount,
                'morethan1year' => $CHPermitAmount * 2,
                'morethan2year' => $CHPermitAmount * 3,
                'morethan3year' => $CHPermitAmount * 4,
                'morethan4year' => $CHPermitAmount * 5,
                'morethan5year' => $CHPermitAmount * 6,
                'morethan6year' => $CHPermitAmount * 7,
                'morethan7year' => $CHPermitAmount * 8,
                default => 0
            };
        }

        return response()->json([
            'success' => true,
            'platenumber' => $platenumber,
            'message' => 'Vehicle Ownership Cost',
            'vehicleCost' => $vehicleCost,
            'hackneyPermitCost' => $hackneyPermitCost,
            'vehicleLicenseCost' => $vehiclelicenseAmount,
            'addVehicleOwnership' => $addVehicleOwnership,
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
