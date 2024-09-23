<?php

namespace App\Http\Controllers\User\AddVehicle;
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
    protected $vehicleRenewalService;

    public function __construct(AddVehicleRenewalService $addVehicleRenewalService)
    {
        $this->addVehicleRenewalService = $addVehicleRenewalService;
    }

    public function index()
    {
        $vehicleList = VehicleType::all();
        return view('user.pages.addVehicle.addVehicleRenewal', compact('vehicleList'));
    }

    public function postAddVehicleRenewal(Request $request){
    
        try{
            // Handle file uploads
            $vhdocument = $this->addVehicleRenewalService->handleFileUpload($request, 'vehiclelicensepapers', 'documents/vehiclerenewals');
            $ipdocument = $this->addVehicleRenewalService->handleFileUpload($request, 'insurancepapers', 'documents/vehiclerenewals');
            $rwpdocument = $this->addVehicleRenewalService->handleFileUpload($request, 'roadworthinesspapers', 'documents/vehiclerenewals');
            $hackneypermitpaper = $this->addVehicleRenewalService->handleFileUpload($request, 'hackneypermitpaper', 'documents/vehiclerenewals');
            $statecarriagepermit = $this->addVehicleRenewalService->handleFileUpload($request, 'statecarriagepermit', 'documents/vehiclerenewals');
            $midyearpermit = $this->addVehicleRenewalService->handleFileUpload($request, 'midyearpermit', 'documents/vehiclerenewals');
            $localgovernmentpermit = $this->addVehicleRenewalService->handleFileUpload($request, 'localgovernmentpermit', 'documents/vehiclerenewals');
            $moiddocument = $this->addVehicleRenewalService->handleFileUpload($request, 'meansofid', 'documents/vehiclerenewals');

            // Save the data
            $vehiclerenewal = new AddVehicleRenewal();
            $vehiclerenewal->fill($request->all());
            $vehiclerenewal->user_id = Auth::user()->id;
            $vehiclerenewal->userType = 'user';
            $vehiclerenewal->user_email= Auth::user()->email;
            $vehiclerenewal->vehiclelicensepapers = 'vehiclerenewals/'.$vhdocument;
            $vehiclerenewal->insurancepapers =  'vehiclerenewals/'.$ipdocument;
            $vehiclerenewal->roadworthinesspapers = 'vehiclerenewals/'.$rwpdocument;
            $vehiclerenewal->hackneypermitpaper = 'vehiclerenewals/'.$hackneypermitpaper;
            $vehiclerenewal->statecarriagepermit = 'vehiclerenewals/'.$statecarriagepermit;
            $vehiclerenewal->midyearpermit = 'vehiclerenewals/'.$midyearpermit;
            $vehiclerenewal->localgovernmentpermit = 'vehiclerenewals/'.$localgovernmentpermit;
            $vehiclerenewal->meansofid = 'vehiclerenewals/'.$moiddocument;
            $vehiclerenewal->save();
       
            return redirect()->route('home.vehicleRenewalPaper')->withSuccess('New Vehicle Renewal has been successfully created.');
        
        } catch (\Exception $e) {
             return redirect()->back()->withError('Somthing went wrong in saving Vehicle Renewal data.'. $e->getMessage());
        }
    }

    public function  vehicleRenewalPaper(){ 
       
        return view('user.pages.process.vehicleRenewalPaper');
    }

    // VehicleRenewalController.php
    public function getUserAddVehiclesRenewal()
    {
        $user = Auth::user();
        $id = $user->id;
        $states = State::all();
        $vehicleCount = AddVehicleRenewal::where('user_id', $id)->count();
        $vehicleList = AddVehicleRenewal::where('user_id', $id)->get();
       

        return response()->json([
            'vehicleCount' => $vehicleCount,
            'vehicleList' => $vehicleList,
            'stateList' => $states
        ]);
    } 

    public function handleStateSelection(Request $request)
    {
        $userId = Auth::id();
        $stateId = $request->input('stateId');
        $addVehiclerenewal = AddVehicleRenewal::where('user_id', $userId)->get();

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

    public function handleVehicleCategoryIdSelection(Request $request){
        $userId = Auth::id();
        $userEmail = Auth::user()->email;
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $stateId = $request->input('stateId');

        $vehicleList = AddVehicleRenewal::where('user_id', $userId)
                                            ->where('category', $vehicleCategoryId)
                                            ->where('user_email', $userEmail)
                                            ->get();

                      
        return response()->json([
            'success' => true,
            'message' => 'Vehicle ID received successfully',
            'vehicleList' => $vehicleList,
           
        ]);
    }

    public function handleAddVehicleValueSelection(Request $request){
        $userId = Auth::id();
        $userEmail = Auth::user()->email;
        $vehicleCategoryId = $request->input('vehicleCategoryId');
        $stateId = $request->input('stateId');
        $addVehicleValue = $request->input('addVehicleValue');

        $vehicleRenewalPrice = VehicleRenewalPrice::with(['vehicleType', 'stateInfo'])
                                            ->where('state_id', $stateId)
                                            ->where('vehicleType_id', $vehicleCategoryId)
                                            ->first(); // Changed to `first()` to get a single record
                      
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
            $userId = Auth::id();
            $userEmail = Auth::user()->email;
            $userType = $request->input('userType');
            $stateId = $request->input('stateId');
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
                'ownerEmail' => '',
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
