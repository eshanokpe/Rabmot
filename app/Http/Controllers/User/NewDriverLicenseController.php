<?php

namespace App\Http\Controllers\User;

use Auth; 
use Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\State;
use App\Models\NewDriverLicensePrice;
use App\Models\DealerPlateNumber;
use App\Models\NewDriverLicense;


class NewDriverLicenseController extends Controller
{ 
    public function index(){
        return view('user.pages.process.newDriverLicense');
    }

    public function getState(){
        $states = State::all();

        return response()->json([
            'stateList' => $states,
        ]);
    }
    
    public function getNDLengthYears(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $stateId = $request->input('stateId');

        $lengthYears = NewDriverLicensePrice::where('state_id', $stateId)
        ->get();

        return response()->json([
            'lengthYears' => $lengthYears,
        ]);
    }

    public function getNDLPrice(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $stateId = $request->input('stateId');
        $lengthYear = $request->input('lengthYear');

        $lengthYears = NewDriverLicensePrice::where('years_type', $lengthYear)
                                                ->where('state_id', $stateId)
                                                ->get();

        return response()->json([
            'amount' => $lengthYears->first()->amount,
        ]);
    }

    public function postNewDriverLicense(Request $request){
        try{
            $userId = Auth::id();
            $userEmail = Auth::user()->email;

            $request->validate([
                'nin' => 'required|integer',  
            ]);
            $userType = $request->input('userType');
            $stateId = $request->input('stateId');
            $lengthYear = $request->input('lengthYear');
            $firstName = $request->input('firstName');
            $middleName = $request->input('middleName');
            $lastName = $request->input('lastName');
            $motherMaidenName = $request->input('motherMaidenName');
            $emailAddress = $request->input('emailAddress');
            $dob = $request->input('dob');
            $nin = $request->input('nin');
            $gender = $request->input('gender');
            $phoneNumber = $request->input('phoneNumber');
            $userState = $request->input('userState');
            $localGovernmentDOB = $request->input('localGovernment');
            $localGovernmentPOB = $request->input('localGovernmentPOB');
            $maritalStatus = $request->input('maritalStatus');
            $bloodGroup = $request->input('bloodGroup');
            $height = $request->input('height');
            $nextofkinName = $request->input('nextofkinName');
            $phoneNextofkinName = $request->input('phoneNextofkinName');
            $contactAddress = $request->input('contactAddress');
            $totalAmount = $request->input('totalAmount');

            $randomNumber = mt_rand(100000, 999999);
            $processId = 'PRONDL' . $randomNumber;

            NewDriverLicense::create([
                'user_id' => $userId,
                'user_email' => $userEmail,
                'userType' => $userType,
                'process_id' => $processId,
                'process_type' => 'New Driver License',
                'state_id' => $stateId,
                'lengthofyear' => $lengthYear,
                'firstname' => $firstName,
                'middlename' => $middleName,
                'lastname' => $lastName,
                'mothermaidenname' => $motherMaidenName,
                'email' => $emailAddress,
                'gender' => $gender, 
                'dateofbirth' => $dob,
                'maritalstatus' => $maritalStatus,
                'nin'=> $nin,
                'localgovernment' => $localGovernmentDOB,
                'state' => $userState,
                'localgovtplaceofbirth' => $localGovernmentDOB,
                'phonenumber' => $phoneNumber,
                'bloodgroup' => $bloodGroup,
                'height' => $height,
                'nextofkinname' => $nextofkinName,
                'nextofkinphonenumber' => $phoneNextofkinName,
                'address' => $contactAddress,
                'payment_status' => 0.00,
                'totalamount' => $totalAmount,
            ]); 

            $users = NewDriverLicense::where('process_id', $processId)->first();
        
            Cart::add([
                'id' => $users->id,
                'name' => $users->email,
                'price' => $users->totalamount,
                'qty' => 1,
                'attributes' => array(
                    'process_id' => $users->process_id,
                    'process_type' => $users->process_type,
                    'lengthofyears' => $users->lengthofyear,
                )
            ])->associate('App\Models\NewDriverLicense');

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
