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
            'vehiclelicense' => 'nullable',
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
            'vehiclelicense' => $validated['vehiclelicense'],
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
