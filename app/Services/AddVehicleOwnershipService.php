<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\AddVehicleOwnership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AddVehicleOwnershipService
{
   
    public function handleRegistration(Request $request)
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        
        // Handle file upload for means of ID
        $moiddocument = $this->uploadFile($request, 'meansofid');
        $agreementdocument = $this->uploadFile($request, 'agreement');
        $proofofownershipdocument = $this->uploadFile($request, 'proofofownership');
        $vehiclelicensepapersdocument = $this->uploadFile($request, 'vehiclelicensepapers');
        $custompapers = $this->uploadFile($request, 'custompapers');
 
        // Create vehicle registration record
        $user = Auth::user();

        $vehicleOwnership = AddVehicleOwnership::create([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'userType' => 'user',
            'category' => $request->category,
            'vehiclemake' => $request->vehiclemake,
            'vehiclemodel' => $request->vehiclemodel,
            'yearofmake' => $request->yearofmake,
            'platenumber' => $request->platenumber,
            'chassisnumber' => $request->chassisnumber,
            'enginenumber' => $request->enginenumber,
            'vehiclecolor' => $request->vehiclecolor,
            'vehiclepapername' => $request->vehiclepapername,
            'vehicledocumentname' => $request->vehicledocumentname,
            'registeredaddressofvehicle' => $request->registeredaddressofvehicle,
            'ownerfullname' => $request->ownerfullname,
            'ownersNIN' => $request->ownersNIN,
            'address' => $request->address,
            'phonenumber' => $request->phonenumber,
            'emailaddress' => $request->emailaddress,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'vehiclelicenseexpiry' => $request->vehiclelicenseexpiry,
            'insuranceexpiry' => $request->insuranceexpiry,
            'roadworthinessexpiry' => $request->roadworthinessexpiry,
            'hackneypermitexpiry' => $request->hackneypermitexpiry,
            'statecarriagepermitexpiry' => $request->statecarriagepermitexpiry,
            'midyearpermit' => $request->midyearpermit,
            'localgovernmentpermitexpiry' => $request->localgovernmentpermitexpiry,
            'vehiclelicensepapers' => 'vehicleOwnership/' .$vehiclelicensepapersdocument,
            'proofofownership' => 'vehicleOwnership/' .$proofofownershipdocument,
            'agreement' => 'vehicleOwnership/' .$agreementdocument,
            'custompapers' => 'vehicleOwnership/' . $custompapers,
            'meansofid' => 'vehicleOwnership/' . $moiddocument,
        ]);

    }

    private function uploadFile(Request $request, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('documents/vehicleOwnership'), $filename);
            return $filename;
        }

        return null;
    }
}
