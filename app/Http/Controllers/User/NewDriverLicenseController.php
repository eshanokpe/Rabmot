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
use App\Models\NewDriverLicense;

class NewDriverLicenseController extends Controller
{
    public function index()
    {
        return view('user.pages.process.newDriverLicense');
    }

    public function getState()
    {
        $states = State::all();
        return response()->json(['stateList' => $states]);
    }

    public function getNDLengthYears(Request $request)
    {
        $stateId = $request->input('stateId');
        $lengthYears = NewDriverLicensePrice::where('state_id', $stateId)->get();
        return response()->json(['lengthYears' => $lengthYears]);
    }

    public function getNDLPrice(Request $request)
    {
        $stateId = $request->input('stateId');
        $lengthYear = $request->input('lengthYear');
        $price = NewDriverLicensePrice::where('years_type', $lengthYear)
            ->where('state_id', $stateId)
            ->first();

        return response()->json(['amount' => $price ? $price->amount : 0]);
    }

    public function postNewDriverLicense(Request $request)
    {
        try {
            $userId = Auth::id();
            $userEmail = Auth::user()->email;

            // ✅ Full server-side validation
            $validated = $request->validate([
                'userType'              => 'required|string',
                'stateId'               => 'required|exists:states,id',
                'lengthYear'            => 'required|string',
                'firstName'             => 'required|string|max:255',
                'middleName'            => 'nullable|string|max:255',
                'lastName'              => 'required|string|max:255',
                'motherMaidenName'      => 'required|string|max:255',
                'emailAddress'          => 'required|email',
                'dob'                   => 'required|date|before:today',
                'nin'                   => 'required|digits:11',
                'gender'                => 'required|in:Male,Female,Other',
                'phoneNumber'           => 'required|string|max:20',
                'userState'             => 'required|string|max:255',
                'localGovernment'       => 'required|string|max:255',
                'localGovernmentPOB'    => 'required|string|max:255',
                'maritalStatus'         => 'required|string',
                'bloodGroup'            => 'required|string',
                'height'                => 'required|string|max:50',
                'facialMark'            => 'nullable|string|max:255',
                'glasses'               => 'required|in:Yes,No',
                'disability'            => 'required|string',
                'nextofkinName'         => 'required|string|max:255',
                'phoneNextofkinName'    => 'required|string|max:20',
                'contactAddress'        => 'required|string',
                'totalAmount'           => 'required|numeric|min:0',
            ]);

            $processId = 'PRONDL' . mt_rand(100000, 999999);

            $ndl = NewDriverLicense::create([
                'user_id'               => $userId,
                'user_email'            => $userEmail,
                'userType'              => $validated['userType'],
                'process_id'            => $processId,
                'process_type'          => 'New Driver License',
                'state_id'              => $validated['stateId'],
                'lengthofyear'          => $validated['lengthYear'],
                'firstname'             => $validated['firstName'],
                'middlename'            => $validated['middleName'],
                'lastname'              => $validated['lastName'],
                'mothermaidenname'      => $validated['motherMaidenName'],
                'email'                 => $validated['emailAddress'],
                'gender'                => $validated['gender'],
                'dateofbirth'           => $validated['dob'],
                'maritalstatus'         => $validated['maritalStatus'],
                'nin'                   => $validated['nin'],
                'localgovernment'       => $validated['localGovernment'],
                'state'                 => $validated['userState'],
                'localgovtplaceofbirth' => $validated['localGovernmentPOB'],
                'phonenumber'           => $validated['phoneNumber'],
                'bloodgroup'            => $validated['bloodGroup'],
                'height'                => $validated['height'],
                'facialmark'            => $validated['facialMark'],
                'glasses'               => $validated['glasses'],
                'disability'            => $validated['disability'],
                'nextofkinname'         => $validated['nextofkinName'],
                'nextofkinphonenumber'  => $validated['phoneNextofkinName'],
                'address'               => $validated['contactAddress'],
                'payment_status'        => 0,
                'totalamount'           => $validated['totalAmount'],
            ]);

            Cart::add([
                'id'         => $ndl->id,
                'name'       => $ndl->email,
                'price'      => $ndl->totalamount,
                'qty'        => 1,
                'attributes' => [
                    'process_id'     => $ndl->process_id,
                    'process_type'   => $ndl->process_type,
                    'lengthofyears'  => $ndl->lengthofyear,
                ]
            ])->associate(NewDriverLicense::class);

            return response()->json(['message' => 'Application saved successfully!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'An error occurred. Please try again.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function getNewDriverLicense()
    {
        $user = Auth::user();
        $ndlRecord = NewDriverLicense::where('user_id', $user->id)->latest()->first();

        return response()->json([
            'user' => [
                'firstname'             => $ndlRecord->firstname       ?? $user->firstname        ?? '',
                'middlename'            => $ndlRecord->middlename      ?? $user->middlename       ?? '',
                'lastname'              => $ndlRecord->lastname        ?? $user->lastname         ?? '',
                'mother_maiden_name'    => $ndlRecord->mothermaidenname ?? $user->mother_maiden_name ?? '',
                'email'                 => $ndlRecord->email           ?? $user->email            ?? '',
                'nin'                   => $ndlRecord->nin             ?? $user->nin              ?? '',
                'dob'                   => $ndlRecord->dateofbirth     ?? $user->dob              ?? '',
                'gender'                => $ndlRecord->gender          ?? $user->gender           ?? '',
                'state'                 => $ndlRecord->state           ?? $user->state            ?? '',
                'phone'                 => $ndlRecord->phonenumber     ?? $user->phone            ?? '',
                'address'               => $ndlRecord->address         ?? $user->address          ?? '',
                'local_government'      => $ndlRecord->localgovernment ?? $user->local_government ?? '',
                'local_government_pob'  => $ndlRecord->localgovtplaceofbirth ?? $user->local_government_pob ?? '',
                'marital_status'        => $ndlRecord->maritalstatus   ?? $user->marital_status   ?? '',
                'blood_group'           => $ndlRecord->bloodgroup      ?? '',
                'height'                => $ndlRecord->height          ?? '',
                'facial_mark'           => $ndlRecord->facialmark      ?? '',
                'glasses'               => $ndlRecord->glasses         ?? '',
                'disability'            => $ndlRecord->disability      ?? '',
                'nextofkin_name'        => $ndlRecord->nextofkinname   ?? '',
                'nextofkin_phone'       => $ndlRecord->nextofkinphonenumber ?? '',
            ]
        ]);
    }
}