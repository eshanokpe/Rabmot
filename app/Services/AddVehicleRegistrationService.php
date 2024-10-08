<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\AddVehicleRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AddVehicleRegistrationService
{
   

    public function handleRegistration(Request $request)
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        
        // Handle file upload for means of ID
        $moiddocument = $this->uploadFile($request, 'meansofid');
        
        // Handle file upload for custom papers
        $custompapers = $this->uploadFile($request, 'custompapers');

        // Create vehicle registration record
        AddVehicleRegistration::create([
            'user_id' => $id,
            'userType' => 'user',
            'user_email' => $email,
            'category' => $request->category,
            'vehiclemake' => $request->vehiclemake,
            'vehiclemodel' => $request->vehiclemodel,
            'year_of_make' => $request->year_of_make,
            'chassisnumber' => $request->chassisnumber,
            'enginenumber' => $request->enginenumber,
            'vehiclecolor' => $request->vehiclecolor,
            'applicantfullname' => $request->applicantfullname,
            'applicantNIN' => $request->applicantNIN,
            'residentialaddress' => $request->residentialaddress,
            'phonenumber' => $request->phonenumber,
            'emailaddress' => $request->emailaddress,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'dateofbirth' => $request->dateofbirth,
            'maritalstatus' => $request->maritalstatus,
            'state' => $request->state,
            'custompapers' => 'vehicleRegistration/' . $custompapers,
            'meansofid' => 'vehicleRegistration/' . $moiddocument,
            'created_date' => Carbon::now()->format('d F Y'),
            'created_month' => Carbon::now()->format('F'),
            'created_year' => Carbon::now()->format('Y'),
            'created_at' => Carbon::now(),
        ]);
    }

    private function uploadFile(Request $request, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('documents/vehicleRegistration'), $filename);
            return $filename;
        } 

        return null;
    }
}
