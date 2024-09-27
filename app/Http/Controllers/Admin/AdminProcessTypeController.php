<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehiclePaperRenewal;
use App\Models\VehicleRegistration;
use App\Models\ChangeOfOwnership;
use App\Models\NewDriverLicense;
use App\Models\DriverLicenseRenewal;

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
        return view('admin.pages.processType.changeOfOwnership', compact('items'));
    }

    public function viewChangeOfOwnership($id){
        $items = ChangeOfOwnership::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.viewChangeOfOwnership', compact('items'));
    }

    public function downloadChangeOfOwnershipLicensePaper(){
        $item = ChangeOfOwnership::findOrFail($id);
        $filePath = $item->passport;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('document/'.$filePath));
    }

    public function downloadChangeOfOwnershipProof(){
        $item = ChangeOfOwnership::findOrFail($id);
        $filePath = $item->passport;
        if (empty($filePath)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('document/'.$filePath));
    }

    public function downloadChangeOfOwnershipAgreement(){
        $item = ChangeOfOwnership::findOrFail($id);
        $filePath = $item->passport;
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('document/'.$filePath));
     }

    public function downloadChangeOfOwnershipMeansOfId(){
        $item = ChangeOfOwnership::findOrFail($id);
        $filePath = $item->passport;
        if (empty($filePath)) {
           return redirect()->back()->with('error', 'No document uploaded for this record.');
        }
        return response()->download(public_path('document/'.$filePath));
    }

    public function processNewDriverlicense(){
        $items = NewDriverLicense::latest()->paginate(10);
        return view('admin.pages.processType.newDriverLicense', compact('items'));
    }

    public function viewNewDriverLicense($id){
        $items = NewDriverLicense::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.viewNewDriverLicense',compact('items'));
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


}
