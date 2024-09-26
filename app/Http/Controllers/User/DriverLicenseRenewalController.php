<?php

namespace App\Http\Controllers\User;

use Auth; 
use Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\State;
use App\Models\DriverLicenseRenewalPrice;
use App\Models\DriverLicenseRenewal;


class DriverLicenseRenewalController extends Controller
{
    public function index(){
        return view('user.pages.process.driverLicenseRenewal');
    }

    public function getState(){
        $states = State::all();

        return response()->json([
            'stateList' => $states,
        ]);
    }
    
    public function getDLRLengthYears(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $stateId = $request->input('stateId');

        $lengthYears = DriverLicenseRenewalPrice::where('state_id', $stateId)
        ->get();

        return response()->json([
            'lengthYearsList' => $lengthYears,
        ]);
    }

    public function getDLRPrice(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $stateId = $request->input('stateId');
        $lengthYear = $request->input('lengthYear');

        $lengthYears = DriverLicenseRenewalPrice::where('years_type', $lengthYear)
                                                    ->where('state_id', $stateId)
                                                    ->get();

        return response()->json([
            'amount' => $lengthYears->first()->amount,
        ]);
    }

    public function postDriverLicenseRenewal(Request $request){
        try{
            $userId = Auth::id();
            $userEmail = Auth::user()->email;

            $request->validate([
                'expiredDriverLicense' => 'required|mimes:jpeg,jpg,png,docx,doc|max:9048',
            ]); 

            $stateId = $request->input('stateId');
            $lengthYear = $request->input('lengthYear');
            $firstName = $request->input('firstName');
            $middleName = $request->input('middleName');
            $lastName = $request->input('lastName');
            $emailAddress = $request->input('emailAddress');
            $dob = $request->input('dob');
            $phoneNumber = $request->input('phoneNumber');
            $contactAddress = $request->input('contactAddress');
            $totalAmount = $request->input('totalAmount');

            $randomNumber = mt_rand(100000, 999999);
            $processId = 'PRODLR' . $randomNumber;

            if ($request->hasFile('expiredDriverLicense')) {
                $expiredFile = $request->file('expiredDriverLicense');
                $expiredPath = $expiredFile->getClientOriginalName();
                $expiredFile->move(public_path('documents/driverLicenseRenewal'), $expiredPath);
            }

            DriverLicenseRenewal::create([
                'user_id' => $userId,
                'userType' => $userId,
                'user_email' =>  $userEmail,
                'process_id' => $processId,
                'process_type' => 'Driver License Renewal',
                'state_id' => $stateId,
                'lengthofyear' => $lengthYear,
                'firstname' => $firstName,
                'middlename' => $middleName,
                'lastname' => $lastName,
                'dob' => $dob,
                'email' => $emailAddress,
                'phone' => $phoneNumber,
                'address' => $contactAddress,
                'document' => isset($expiredPath) ? 'driverLicenseRenewal/' . $expiredPath : null,
                'payment_status' => 0.00,
                'totalAmount' => $totalAmount
            ]);

            $users = DriverLicenseRenewal::where('process_id', $processId)->first();
        
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
            ])->associate('App\Models\DriverLicenseRenewal');
    

            return response()->json([
                'totalAmount' => $totalAmount,
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