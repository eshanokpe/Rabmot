<?php

namespace App\Http\Controllers\User;

use Auth; 
use Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\State;
use App\Models\OtherPermitPrice;
use App\Models\OtherPermit;
use App\Models\OtherPermitType;

class OtherPermitController extends Controller
{
    public function index(){
        return view('user.pages.process.otherPermit');
    }

    public function getPermitType(){
        $permitType = OtherPermitType::all();

        return response()->json([
            'permitType' => $permitType,
        ]);
    }
 
    public function getPrice(Request $request){
        $permitTypeId = $request->input('permitTypeId');
        $otherPermit = OtherPermitPrice::where('permit_type_id', $permitTypeId)
                                                ->get();

        return response()->json([
            'amount' => $otherPermit->first()->amount,
        ]);
    }

    public function postOtherPermit(Request $request){
        try{
            $userId = Auth::id();
            $userEmail = Auth::user()->email;

            // $request->validate([
            //     'passport' => 'nullable|mimes:jpeg,jpg,png,docx,doc|max:9048',
            //     'meansofID' => 'nullable|mimes:jpeg,jpg,png,docx,doc|max:9048',
            // ]);            
            
            //RiderCard
            $userType = $request->input('userType');
            $permitTypeId = $request->input('permitTypeId');
            $firstName = $request->input('firstName');
            $middleName = $request->input('middleName');
            $lastName = $request->input('lastName');
            $maidenName = $request->input('maidenName');
            $gender = $request->input('gender');
            $dob = $request->input('dob');
            $maritalStatus = $request->input('maritalStatus');
            $lGovtPOB = $request->input('lGovtPOB');
            $stateOrigin = $request->input('stateOrigin');
            $emailAddress = $request->input('emailAddress');
            $phoneNumber = $request->input('phoneNumber');
            $lGovtOrigin = $request->input('lGovtOrigin');
            $bloodGroup = $request->input('bloodGroup');
            $height = $request->input('height');
            $nextKinName = $request->input('nextKinName');
            $nextKinPhoneNumber = $request->input('nextKinPhoneNumber');
            $contactAddress = $request->input('contactAddress');
            //LocalGovt
            $vehicleDocumentsName = $request->input('vehicleDocumentsName');
            $vehicleMake = $request->input('vehicleMake');
            $vehicleModel = $request->input('vehicleModel');
            $registrationNumber = $request->input('registrationNumber');

            $purpose = $request->input('purpose');
            $nin = $request->input('nin');
            $classLicenses = $request->input('classLicenses');
            $lengthOfYears = $request->input('lengthOfYears');
            $reasonfor = $request->input('reasonfor');
             
            $totalAmount = $request->input('totalAmount');

            $passportFile = null; 
            $passportPath = null;
            if ($request->hasFile('passport')) {
                $passportFile = $request->file('passport');
                if ($passportFile) {
                    $passportPath = $passportFile->getClientOriginalName();
                    $passportFile->move(public_path('documents/otherPermit'), $passportPath);
                }
            } 
            $meansofIDFile = null; 
            $meansofIDPath = null;
            if ($request->hasFile('meansofID')) {
                $meansofIDFile = $request->file('meansofID');
                if ($meansofIDFile) {
                    $meansofIDPath = $meansofIDFile->getClientOriginalName();
                    $meansofIDFile->move(public_path('documents/otherPermit'), $meansofIDPath);
                }
            } 
            $picsVehicleLicenseFile = null; 
            $picsVehicleLicensePath = null;
            if ($request->hasFile('picsVehicleLicense')) {
                $picsVehicleLicenseFile = $request->file('picsVehicleLicense');
                if ($picsVehicleLicenseFile) {
                    $picsVehicleLicensePath = $picsVehicleLicenseFile->getClientOriginalName();
                    $picsVehicleLicenseFile->move(public_path('documents/otherPermit'), $picsVehicleLicensePath);
                }
            } 

            $affidavitFile = null; 
            $affidavitPath = null;
            if ($request->hasFile('affidavit')) {
                $affidavitFile = $request->file('affidavit');
                if ($affidavitFile) {
                    $affidavitPath = $affidavitFile->getClientOriginalName();
                    $affidavitFile->move(public_path('documents/otherPermit'), $affidavitPath);
                }
            } 

            $policereportFile = null; 
            $policereportPath = null;
            if ($request->hasFile('policereport')) {
                $policereportFile = $request->file('policereport');
                if ($policereportFile) {
                    $policereportPath = $policereportFile->getClientOriginalName();
                    $policereportFile->move(public_path('documents/otherPermit'), $policereportPath);
                }
            } 

            $proofofownershipFile = null; 
            $proofofownershipPath = null;
            if ($request->hasFile('proofofownership')) {
                $proofofownershipFile = $request->file('proofofownership');
                if ($proofofownershipFile) {
                    $proofofownershipPath = $proofofownershipFile->getClientOriginalName();
                    $proofofownershipFile->move(public_path('documents/otherPermit'), $proofofownershipPath);
                }
            } 

            $randomNumber = mt_rand(100000, 999999);
            $processId = 'PROOP' . $randomNumber;
            OtherPermit::create([
                'user_id' => $userId, 
                'user_email' => $userEmail,
                'userType' => $userType,
                'process_id' => $processId,
                'process_type' => 'Other Permit',
                'permittype' => $permitTypeId,
                //RiderCard
                'firstname' => $firstName,
                'middlename' => $middleName,
                'lastname' => $lastName,
                'mothermaidenname' => $maidenName,
                'email' => $emailAddress,
                'gender' => $gender,
                'dateofbirth' => $dob,
                'maritalstatus' => $maritalStatus,
                'localgovernment' => $lGovtOrigin,
                'state' => $stateOrigin,
                'localgovtplaceofbirth' => $lGovtPOB,
                'phonenumber' => $phoneNumber,
                'bloodgroup' => $bloodGroup,
                'height' => $height,
                'nextofkinname' => $nextKinName,
                'nextofkinphonenumber' => $nextKinPhoneNumber,
                'address' => $emailAddress,
                'passport' => 'otherPermit/'.$passportPath,
                'meansofID' => 'otherPermit/'.$meansofIDPath,

                //LocaGovtPermit
                'nameofvehicledocuments' => $vehicleDocumentsName,
                'vehicle_make' => $vehicleMake,
                'vehicle_model' => $vehicleModel,
                'reg_number' => $registrationNumber,
                'pictureoftheVehicleLicense' => 'otherPermit/'.$picsVehicleLicensePath,
 
                'affidavit' => 'otherPermit/'.$affidavitPath,
                'policereport' => 'otherPermit/'.$policereportPath,

                'proofofownership' => 'otherPermit/'.$proofofownershipPath,

                'purpose' => $purpose,
                'nin' => $nin,
                'classoflicense' => $classLicenses,
                'lengthofyears' => $lengthOfYears,
                'reasonfor' => $reasonfor,

                'amount' => $totalAmount,
            ]);
            $users = OtherPermit::where('process_id', $processId)->first();
            Cart::add([ 
                'id' => $users->id,
                'name' => $users->process_type,
                'price' => $users->amount,
                'qty' => 1,
            ])->associate('App\Models\OtherPermit');

            return response()->json([
                'message' => 'Documents uploaded successfully!',
            ]);

        } catch (\Exception $e) {
            // Catch any exceptions and return error response
            return response()->json([
                'error' => 'An error occurred during the process. Please try again.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
} 
