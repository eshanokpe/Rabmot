<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleType;
use App\Models\AddVehicleRenewal;
use App\Models\AddVehicleOwnership;
use App\Models\AddVehicleRegistration;


class AdminAddedVehicleController extends Controller
{
    public function showAddVehicleRenewal(){
        $items = AddVehicleRenewal::latest()->paginate(10);
        return view('admin.pages.showAddVehicle.showAddVehicleRenewal', compact('items'));
    }

    public function showVehicleRenewalDetails($id){
        $items = AddVehicleRenewal::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        $vehicleList = VehicleType::all();
        return view('admin.pages.showAddVehicle.showAddVehicleRenewalDetails', compact('items','vehicleList'));
    }
    
    public function updateVehicleRenewal(Request $request, $id)
    {
        $validated = $request->validate([
            'vehiclelicenseexpiry' => 'nullable',
            'insuranceexpiry' => 'nullable',
            'roadworthinessexpiry' => 'nullable',
            'hackneypermitexpiry' => 'nullable',
            'statecarriagepermitexpiry' => 'nullable',
            'hackneydutypermitexpiry' => 'nullable',
            'localgovernmentpermitexpiry' => 'nullable',
            'emailAddress' => 'nullable',
            'category' => 'nullable',
            'vehiclemake' => 'nullable',
            'vehiclemodel' => 'nullable',
            'year0fmake' => 'nullable',
            'platenumber' => 'nullable',
            'chassisnumber' => 'nullable',
            'enginenumber' => 'nullable',
            'vehiclecolor' => 'nullable',
            'vehiclename' => 'nullable',
            'vehicledocumentname' => 'nullable',
            'ownersphonenumber' => 'nullable',
            'registeredaddressofvehicle' => 'nullable',
        ]);
        $post = AddVehicleRenewal::findOrFail($id);
        
        $post->update([
            'vehiclelicenseexpiry' => $validated['vehiclelicenseexpiry'],
            'insuranceexpiry' =>  $validated['insuranceexpiry'],
            'roadworthinessexpiry' =>  $validated['roadworthinessexpiry'],
            'hackneypermitexpiry' =>  $validated['hackneypermitexpiry'],
            'statecarriagepermitexpiry' =>  $validated['statecarriagepermitexpiry'],
            'hackneydutypermitexpiry' =>  $validated['hackneydutypermitexpiry'],
            'localgovernmentpermitexpiry' =>  $validated['localgovernmentpermitexpiry'],
            'emailAddress' =>  $validated['emailAddress'],
            'category' => $validated['category'],
            'vehiclemodel' => $validated['vehiclemodel'],
            'year0fmake' => $validated['year0fmake'],
            'platenumber' => $validated['platenumber'],
            'chassisnumber' => $validated['chassisnumber'],
            'enginenumber' => $validated['enginenumber'],
            'vehiclecolor' => $validated['vehiclecolor'],
            'vehiclename' => $validated['vehiclename'],
            'vehicledocumentname' => $validated['vehicledocumentname'],
            'ownersphonenumber' => $validated['ownersphonenumber'],
            'registeredaddressofvehicle' => $validated['registeredaddressofvehicle'],
        ]);
        return redirect()->back()->with('success', 'Vehicle Renewal Updated successfully.');
    }

    public function downloadVehicleLicensePapers($id)
    {
      $addvehiclerenewal = AddVehicleRenewal::findOrFail(decrypt($id));
      $filePath = $addvehiclerenewal->vehiclelicensepapers;
      if (empty($filePath)) {
         return redirect()->back()->with('error', 'No document uploaded for this record.');
      }
      return response()->download(public_path('/documents/'.$filePath));
    }

    public function downloadVehicleInsurancePapers($id){
        $addvehiclerenewal = AddVehicleRenewal::findOrFail(decrypt($id));
        $filePath = $addvehiclerenewal->insurancepapers;
       
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }
  
    public function downloadVehicleRoadworthiness ($id){
        $addvehiclerenewal = AddVehicleRenewal::findOrFail(decrypt($id));
        $filePath = $addvehiclerenewal->roadworthinesspapers;
       
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }
  
    public function downloadVehicleHackneyPermit($id){
        $addvehiclerenewal = AddVehicleRenewal::findOrFail(decrypt($id));
        $filePath = $addvehiclerenewal->hackneypermitpaper;
       
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }
  
    public function downloadVehicleStateCarriagePermit($id){
        $addvehiclerenewal = AddVehicleRenewal::findOrFail(decrypt($id));
        $filePath = $addvehiclerenewal->statecarriagepermit;
       
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }
  
    public function downloadVehicleLocalGovernmentPermit($id){
        $addvehiclerenewal = AddVehicleRenewal::findOrFail(decrypt($id));
        $filePath = $addvehiclerenewal->localgovernmentpermit;
        
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        
        return response()->download(public_path('/documents/'.$filePath));
    }

    public function downloadVehicleMidyearPermit($id){
        $addvehiclerenewal = AddVehicleRenewal::findOrFail(decrypt($id));
        $filePath = $addvehiclerenewal->midyearpermit;
        
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        
        return response()->download(public_path('/documents/'.$filePath));
    }
  
    public function downloadVehicleMeansOfId($id){
        $addvehiclerenewal = AddVehicleRenewal::findOrFail(decrypt($id));
        $filePath = $addvehiclerenewal->meansofid;
       
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
      
        return response()->download(public_path('/documents/'.$filePath));
    }

    public function showAddNewVehicleRegistration(){
        $items = AddVehicleRegistration::latest()->paginate(10);
        return view('admin.pages.showAddVehicle.showAddNewVehicleRegistration', compact('items'));
    }

    public function showAddNewVehicleRegistrationDetails($id){
        $items = AddVehicleRegistration::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        $vehicleList = VehicleType::all();
        return view('admin.pages.showAddVehicle.showAddNewVehicleRegistrationDetails', compact('items','vehicleList'));
    }

    public function updateVehicleRegistration(Request $request, $id)
    {
        try{
             // Validate the incoming request data
            $request->validate([
                // 'user_email' => 'required|email',
                'category' => 'required|string|max:255',
                'vehiclemake' => 'required|string|max:255',
                'vehiclemodel' => 'nullable|string|max:255',
                'year_of_make' => 'nullable|integer',
                'chassisnumber' => 'nullable|string|max:255',
                'enginenumber' => 'nullable|string|max:255',
                'vehiclecolor' => 'nullable|string|max:255',
                'applicantfullname' => 'nullable|string|max:255',
                'applicantNIN' => 'nullable|string|max:255',
                'residentialaddress' => 'nullable|string|max:255',
                'phonenumber' => 'nullable|string|max:15',
                'emailaddress' => 'nullable|email|max:255',
                'gender' => 'nullable|string|max:50',
                'occupation' => 'nullable|string|max:255',
                'vehiclelicenseexpiry' => 'nullable|date',
                'maritalstatus' => 'nullable|string|max:50',
                'state' => 'nullable|string|max:255',
            ]);
            $vehicleRegistration = AddVehicleRegistration::findOrFail($id);
            $vehicleRegistration->update([
                'category' => $request->input('category'),
                'vehiclemake' => $request->input('vehiclemake'),
                'vehiclemodel' => $request->input('vehiclemodel'),
                'year_of_make' => $request->input('year_of_make'),
                'chassisnumber' => $request->input('chassisnumber'),
                'enginenumber' => $request->input('enginenumber'),
                'vehiclecolor' => $request->input('vehiclecolor'),
                'applicantfullname' => $request->input('applicantfullname'),
                'applicantNIN' => $request->input('applicantNIN'),
                'residentialaddress' => $request->input('residentialaddress'),
                'phonenumber' => $request->input('phonenumber'),
                'emailaddress' => $request->input('emailaddress'),
                'gender' => $request->input('gender'),
                'occupation' => $request->input('occupation'),
                'vehiclelicenseexpiry' => $request->input('vehiclelicenseexpiry'),
                'maritalstatus' => $request->input('maritalstatus'),
                'state' => $request->input('state'),
                'state' => $request->input('state'),
            ]);

            return redirect()->back()
                         ->withSuccess('Vehicle registration updated successfully.');
    
        }catch(Exception $e){
            return redirect()->back()->withError('Somthing went wrong'.$e->getMessage());
        }
    }

    public function downloadVehicleRegistrationCustomPaper($id)
    {
        $addVehicleRegistration = AddVehicleRegistration::findOrFail(decrypt($id));
        $filePath = $addVehicleRegistration->custompapers;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }

    public function downloadVehicleRegistrationMeansOfId($id)
    {
        $addVehicleRegistration = AddVehicleRegistration::findOrFail(decrypt($id));
        $filePath = $addVehicleRegistration->meansofid;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }

    public function showAddChangeOfOwnership(){
        $items = AddVehicleOwnership::latest()->paginate(10);
        return view('admin.pages.showAddVehicle.showAddChangeOfOwnership', compact('items'));
    }

    public function viewAddChangeOfOwnership($id){
        $items = AddVehicleOwnership::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        $vehicleList = VehicleType::all();
        return view('admin.pages.showAddVehicle.showAddChangeOfOwnershipDetails', compact('items','vehicleList'));
    }

    public function updateChangeOfOwnership(Request $request, $id){
        try {
        $request->validate([
            'category' => 'required|exists:vehicle_types,id',
            'vehiclemake' => 'required|string|max:255',
            'vehiclemodel' => 'nullable|string|max:255',
            'yearofmake' => 'nullable|integer',
            'platenumber' => 'nullable|string|max:255',
            'chassisnumber' => 'nullable|string|max:255',
            'enginenumber' => 'nullable|string|max:255',
            'vehiclecolor' => 'nullable|string|max:255',
            'vehiclepapername' => 'nullable|string|max:255',
            'vehiclelicenseexpiry' => 'nullable|date',
            'insuranceexpiry' => 'nullable|date',
            'roadworthinessexpiry' => 'nullable|date',
            'hackneypermitexpiry' => 'nullable|date',
            'statecarriagepermitexpiry' => 'nullable|date',
            'midyearpermit' => 'nullable|date',
            'localgovernmentpermitexpiry' => 'nullable|date',
            'registeredaddressofvehicle' => 'nullable|string|max:255',
            'ownerfullname' => 'nullable|string|max:255',
            'ownersNIN' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phonenumber' => 'nullable|string|max:15', 
            'emailaddress' => 'nullable|email|max:255',
            'gender' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:255',
        ]);
        // dd('ip');

    
            $vehicle = AddVehicleOwnership::findOrFail($id);

            // Update vehicle details
            $vehicle->category = $request->category;
            $vehicle->vehiclemake = $request->vehiclemake;
            $vehicle->vehiclemodel = $request->vehiclemodel;
            $vehicle->yearofmake = $request->yearofmake;
            $vehicle->platenumber = $request->platenumber;
            $vehicle->chassisnumber = $request->chassisnumber;
            $vehicle->enginenumber = $request->enginenumber;
            $vehicle->vehiclecolor = $request->vehiclecolor;
            $vehicle->vehiclepapername = $request->vehiclepapername;
            $vehicle->registeredaddressofvehicle = $request->registeredaddressofvehicle;
            $vehicle->ownerfullname = $request->ownerfullname;
            $vehicle->ownersNIN = $request->ownersNIN;
            $vehicle->address = $request->address;
            $vehicle->phonenumber = $request->phonenumber;
            $vehicle->emailaddress = $request->emailaddress;
            $vehicle->gender = $request->gender;
            $vehicle->occupation = $request->occupation;

            // Update date fields
            $vehicle->vehiclelicenseexpiry = $request->vehiclelicenseexpiry;
            $vehicle->insuranceexpiry = $request->insuranceexpiry;
            $vehicle->roadworthinessexpiry = $request->roadworthinessexpiry;
            $vehicle->hackneypermitexpiry = $request->hackneypermitexpiry;
            $vehicle->statecarriagepermitexpiry = $request->statecarriagepermitexpiry;
            $vehicle->midyearpermit = $request->midyearpermit;
            $vehicle->localgovernmentpermitexpiry = $request->localgovernmentpermitexpiry;

            // Save updated details
            $vehicle->save();

            return redirect()->back()
                ->withSuccess('Vehicle ownership updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withError('An error occurred while updating the vehicle ownership: ' . $e->getMessage());
        }
    }

    public function downloadChangeOfOwnershipVehicleLicense($id)
    {
        $addVehicleRegistration = AddVehicleOwnership::findOrFail(decrypt($id));
        $filePath = $addVehicleRegistration->vehiclelicensepapers;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }else if($filePath == "vehicleOwnership/"){
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }

    public function downloadChangeOfOwnershipProofOfOwnership($id)
    {
        $addVehicleRegistration = AddVehicleOwnership::findOrFail(decrypt($id));
        $filePath = $addVehicleRegistration->proofofownership;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }else if($filePath == "vehicleOwnership/"){
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }

    public function downloadChangeOfOwnershipAgreements($id)
    {
        $addVehicleRegistration = AddVehicleOwnership::findOrFail(decrypt($id));
        $filePath = $addVehicleRegistration->agreement;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }else if($filePath == "vehicleOwnership/"){
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }

    public function downloadChangeOfOwnershipMeansOfID($id)
    {
        $addVehicleRegistration = AddVehicleOwnership::findOrFail(decrypt($id));
        $filePath = $addVehicleRegistration->meansofid;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }else if($filePath == "vehicleOwnership/"){
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('/documents/'.$filePath));
    }
}
