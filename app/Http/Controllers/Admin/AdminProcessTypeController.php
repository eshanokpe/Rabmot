<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehiclePaperRenewal;
use App\Models\VehicleRegistration;
use App\Models\ChangeOfOwnership;
use App\Models\NewDriverLicense;
use App\Models\DriverLicenseRenewal;
use App\Models\DealerPlateNumber;
use App\Models\InternationalDriverLicense;
use App\Models\OtherPermit;

class AdminProcessTypeController extends Controller
{
    public function processVehiclePaperRenewal(){
        $items = VehiclePaperRenewal::latest()->paginate(10);
        return view('admin.pages.processType.vehiclePaperRenewal', compact('items'));
    }

    public function viewVehiclePaperRenewal($id){
        $items = VehiclePaperRenewal::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.viewVehiclePaperRenewal', compact('items'));
    }

    public function processNewVehicleRegistration(){
        $items = VehicleRegistration::latest()->paginate(10);
        return view('admin.pages.processType.newVehicleRegistration', compact('items'));
    }

    public function viewNewVehicleRegistration($id){
        $items = VehicleRegistration::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.viewNewVehicleRegistration', compact('items'));
    }

    public function processChangeOfOwnership(){ 
        $items = ChangeOfOwnership::latest()->paginate(10);
        return view('admin.pages.processType.changeOfOwnership.changeOfOwnership', compact('items'));
    } 

    public function viewChangeOfOwnership($id){
        $items = ChangeOfOwnership::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.changeOfOwnership.viewChangeOfOwnership', compact('items'));
    }

    public function downloadChangeOfOwnershipLicensePaper($id){
        $item = ChangeOfOwnership::findOrFail($id);
        $filePath = $item->passport;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }

        return response()->download(public_path('document/'.$filePath));
    }

    public function downloadChangeOfOwnershipProof($id){
        $item = ChangeOfOwnership::findOrFail($id);
        $filePath = $item->passport;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('document/'.$filePath));
    }

    public function downloadChangeOfOwnershipAgreement($id){
        $item = ChangeOfOwnership::findOrFail($id);
        $filePath = $item->passport;
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('document/'.$filePath));
     }

    public function downloadChangeOfOwnershipMeansOfId($id){
        $item = ChangeOfOwnership::findOrFail($id);
        $filePath = $item->passport;
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('document/'.$filePath));
    }

    public function processNewDriverlicense(){
        $items = NewDriverLicense::latest()->paginate(10);
        return view('admin.pages.processType.newDriverLicense.newDriverLicense', compact('items'));
    }

    public function viewNewDriverLicense($id){
        $items = NewDriverLicense::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.newDriverLicense.viewNewDriverLicense',compact('items'));
    }

    public function downloadnewDriverlicensedocument($id)
    {
      $item = NewDriverLicense::findOrFail($id);
      $filePath = $item->document;

      if (empty($filePath)) {
         return redirect()->back()->with('error', 'No document uploaded for this record.');
      }

      $filename = storage_path("app/{$filePath}");
      
      if (file_exists($filename)) {
         return response()->download($filename);
      } else {
         // Handle the case where the file does not exist.
         return redirect()->back()->with('error', 'File not found.');
      }
    }

    public function processNewDriverlicenseRenewal(){
        $items = DriverLicenseRenewal::latest()->paginate(10);
        return view('admin.pages.processType.newDriverLicenseRenewal', compact('items'));
    }

    public function viewNewDriverLicenseRenewal($id){
        $items = DriverLicenseRenewal::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.viewNewDriverLicenseRenewal',compact('items'));
    }

    public function downloadnewDriverlicenseRenewaldocument($id)
    {
      $item = DriverLicenseRenewal::findOrFail($id);
      $filePath = $item->document;

      if (empty($filePath)) {
         return redirect()->back()->with('error', 'No document uploaded for this record.');
      }

      $filename = storage_path("app/{$filePath}");
      
      if (file_exists($filename)) {
         return response()->download($filename);
      } else {
         // Handle the case where the file does not exist.
         return redirect()->back()->with('error', 'File not found.');
      }
    }

    public function processInternationalDriverLicense(){
        $items = InternationalDriverLicense::latest()->paginate(10);
        return view('admin.pages.processType.internationalDriverLicense.internationalDriverLicense', compact('items'));
    }

    public function viewInternationalDriverLicense($id){
        $items = InternationalDriverLicense::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.internationalDriverLicense.viewInternationalDriverLicense',compact('items'));
    }

    public function downloadInternationalDriverLicensePassPort($id){
        
        $item = InternationalDriverLicense::findOrFail($id);
        $filePath = $item->passport;
    
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
    
        $fullPath = public_path('internationalDriverLicense/' . $filePath);
    
        if (!file_exists($fullPath)) {
            return redirect()->back()->with('error', 'The requested document does not exist.');
        }
    
        return response()->download($fullPath);
    }
    
    public function processDealerPlateNumber(){
        $items = DealerPlateNumber::latest()->paginate(10);
        return view('admin.pages.processType.dealerPlateNumber.dealerPlateNumber', compact('items'));
    }

    public function viewDealerPlateNumber($id){
        $items = DealerPlateNumber::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.dealerPlateNumber.viewDealerPlateNumber',compact('items'));
    }

    public function downloadPlateNumberPassPort($id){
        $item = DealerPlateNumber::findOrFail($id);
        $filePath = $item->passport;
    
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
    
        $fullPath = public_path('DealerPlateNumber/' . $filePath);
    
        if (!file_exists($fullPath)) {
            return redirect()->back()->with('error', 'The requested document does not exist.');
        }
    
        return response()->download($fullPath);
    }

    public function downloadPlateNumberCertificate($id){
        $item = DealerPlateNumber::findOrFail($id);
        $filePath = $item->passport;
    
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
    
        $fullPath = public_path('DealerPlateNumber/' . $filePath);
    
        if (!file_exists($fullPath)) {
            return redirect()->back()->with('error', 'The requested document does not exist.');
        }
    
        return response()->download($fullPath);
    }

    public function downloadPlateNumberCompanyLetterhead($id){
        $item = DealerPlateNumber::findOrFail($id);
        $filePath = $item->passport;
    
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
    
        $fullPath = public_path('DealerPlateNumber/' . $filePath);
    
        if (!file_exists($fullPath)) {
            return redirect()->back()->with('error', 'The requested document does not exist.');
        }
    
        return response()->download($fullPath);
    }

    public function processOtherPermit(){
        $items = OtherPermit::latest()->paginate(10);
        return view('admin.pages.processType.otherPermit.otherPermit', compact('items'));
    }

    public function viewOtherPermit($id){
        $items = OtherPermit::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.otherPermit.viewOtherPermit',compact('items'));
    }
        

}
