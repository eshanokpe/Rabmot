<?php

namespace App\Http\Controllers\User;

use Auth; 
use Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\State;
use App\Models\InternationalDriverLicensePrice;
use App\Models\InternationalDriverLicense;

class InternationalDriverLicenseController extends Controller
{
    public function index(){
        return view('user.pages.process.internationalDriverLicense');
    }

    public function getState(){
        $states = State::all();

        return response()->json([
            'stateList' => $states,
        ]);
    }

    public function getIDLLengthYears(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $stateId = $request->input('stateId');

        $lengthYears = InternationalDriverLicensePrice::where('state_id', $stateId)
        ->get();

        return response()->json([
            'lengthYearsList' => $lengthYears,
        ]);
    }
    
    public function getIDLPrice(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $stateId = $request->input('stateId');
        $lengthYear = $request->input('lengthYear');

        $lengthYears = InternationalDriverLicensePrice::where('years_type', $lengthYear)
                                                ->where('state_id', $stateId)
                                                ->get();

        return response()->json([
            'amount' => $lengthYears->first()->amount,
        ]);
    }

    public function postInternationalDriverLicense(Request $request){
        try{
            $userId = Auth::id();
            $userEmail = Auth::user()->email;

            $request->validate([
                'passport' => 'required|mimes:jpeg,jpg,png,docx,doc|max:9048',
            ]);

            $userType = $request->input('userType');
            $stateId = $request->input('stateId');
            $lengthYear = $request->input('lengthYear');
            $firstName = $request->input('firstName');
            $middleName = $request->input('middleName');
            $lastName = $request->input('lastName');
            $emailAddress = $request->input('emailAddress');
            $gender = $request->input('gender');
            $maritalStatus = $request->input('maritalStatus');
            $phoneNumber = $request->input('phoneNumber');
            $dob = $request->input('dob');
            $lGovtOrigin = $request->input('lGovtOrigin');
            $stateOrigin = $request->input('stateOrigin');
            $lGovtPOB = $request->input('lGovtPOB');
            $contactAddress = $request->input('contactAddress');
            $totalAmount = $request->input('totalAmount');

            if ($request->hasFile('passport')) {
                $passportFile = $request->file('passport');
                $passportPath =  $passportFile->getClientOriginalName();
                $passportFile->move(public_path('documents/internationalDriverLicense'), $passportPath);
            }
            $randomNumber = mt_rand(100000, 999999);
            $processId = 'PROIDL' . $randomNumber;

            InternationalDriverLicense::create([
                'user_id' => $userId, 
                'userType' => $userType,
                'user_email' => $userEmail,
                'process_id' => $processId,
                'process_type' => 'International Driver License',
                'lengthofyear' => $lengthYear,
                'firstname' => $firstName,
                'middlename' => $middleName,
                'lastname' => $lastName,
                'email' => $emailAddress,
                'gender' => $gender,
                'dateofbirth' => $dob,
                'maritalstatus' => $maritalStatus,
                'localgovernment' => $lGovtOrigin,
                'state' => $stateOrigin,
                'localgovtplaceofbirth' => $lGovtPOB,
                'phonenumber' => $phoneNumber,
                'address' => $contactAddress,
                'passport' => 'internationalDriverLicense/'.$passportPath,
                'totalAmount' => $totalAmount,
            ]);
            $users = InternationalDriverLicense::where('process_id', $processId)->first();
            Cart::add([
                'id' => $users->id,
                'name' => $users->email,
                'price' => $users->totalAmount,
                'qty' => 1,
                'option' => array(
                    'process_id' => $users->process_id,
                    'process_type' => $users->process_type,
                    'lengthofyear' => $users->lengthofyear,
                )
            ])->associate('App\Models\InternationalDriverLicense');
        

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
