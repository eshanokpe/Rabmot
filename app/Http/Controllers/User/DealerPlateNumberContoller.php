<?php

namespace App\Http\Controllers\User;

use Auth; 
use Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\State;
use App\Models\DealersPlateNumberPrice;
use App\Models\DealerPlateNumber; 


class DealerPlateNumberContoller extends Controller
{
    public function index(){
        return view('user.pages.process.dealerPlateNumber');
    }

    public function getState(){
        $states = State::all();

        return response()->json([
            'stateList' => $states,
        ]);
    }

    public function getDPNPrice(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $stateId = $request->input('stateId');

        $amount = DealersPlatenumberPrice::where('state_id', $stateId)
        ->get();

        return response()->json([
            'amount' => $amount->first()->amount
        ]);
    }
   

    public function postDealerPlateNumber(Request $request){
        try{
            $userId = Auth::id();
            $userEmail = Auth::user()->email;

            $request->validate([
                'caccertificate' => 'required|mimes:jpeg,jpg,png,docx,doc|max:9048',
                'passport' => 'required|mimes:jpeg,jpg,png|max:9048',
                'companyletterhead' => 'required|mimes:jpeg,jpg,png|max:9048',
            ]);
            $userType = $request->input('userType');
            $stateId = $request->input('stateId');
            $fullName = $request->input('fullname');
            $companyName = $request->input('companyName');
            $emailAddress = $request->input('emailAddress');
            $phoneNumber = $request->input('phoneNumber');
            $gender = $request->input('gender');
            $maritalStatus = $request->input('maritalStatus');
            $dob = $request->input('dob');
            $pob = $request->input('pob');
            $residentAddress = $request->input('residentAddress');
            $userState = $request->input('userState');
            $localGovernment = $request->input('localGovernment');
            $totalAmount = $request->input('totalAmount');

            if ($request->hasFile('caccertificate')) {
                $cacFile = $request->file('caccertificate');
                $cacPath =  $cacFile->getClientOriginalName();
                $cacFile->move(public_path('documents/dealerPlateNumber'), $cacPath);
            }
        
            if ($request->hasFile('passport')) {
                $passportFile = $request->file('passport');
                $passportPath = $passportFile->getClientOriginalName();
                $passportFile->move(public_path('documents/dealerPlateNumber'), $passportPath);
            }
        
            if ($request->hasFile('companyletterhead')) {
                $letterheadFile = $request->file('companyletterhead');
                $letterheadPath =  $letterheadFile->getClientOriginalName();
                $letterheadFile->move(public_path('documents/dealerPlateNumber'), $letterheadPath);
            }

            $randomNumber = mt_rand(100000, 999999);
            $processId = 'PRODPN' . $randomNumber;

            DealerPlateNumber::create([
                'user_id' => $userId,
                'user_email' =>  $userEmail,
                'userType' =>  $userType,
                'state_id' => $stateId,
                'fullname' => $fullName,
                'companyName' => $companyName,
                'process_id' => $processId,
                'process_type' => 'Dealer`s Plate Number',
                'email' => $emailAddress,
                'phonenumber' => $phoneNumber,
                'gender' => $gender,
                'maritalstatus' => $maritalStatus,
                'dateofbirth' => $dob,
                'placeofbirth' => $pob,
                'address' => $residentAddress,
                'state' => $userState,
                'localgovernment' => $localGovernment,
                'caccertificate' => isset($cacPath) ? 'dealerPlateNumber/' . $cacPath : null,
                'passport' => isset($passportPath) ? 'dealerPlateNumber/' . $passportPath : null,
                'companyletterhead' => isset($letterheadPath) ? 'dealerPlateNumber/' . $letterheadPath : null,
                'payment_status' => 0.0,
                'totalamount' => $totalAmount,
            ]);
            $users = DealerPlateNumber::where('process_id', $processId)->first();
            Cart::add([
                'id' => $users->id,
                'name' => $users->email,
                'price' => $users->totalamount,
                'qty' => 1,
                'attributes' => array(
                    'process_id' => $users->process_id,
                    'process_type' => $users->process_type,
                    'lengthofyears' => $users->lengthofyears,
                )
            ])->associate('App\Models\DealerPlateNumber');
            
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
