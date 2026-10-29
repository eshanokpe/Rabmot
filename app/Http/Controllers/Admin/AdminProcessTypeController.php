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
use Illuminate\Support\Collection;

class AdminProcessTypeController extends Controller
{
    public function documents(Request $request)
    {
        $services = [
            [
                'key' => 'vehicle_licence_renewal',
                'label' => 'Vehicle Licence Renewal',
                'model' => VehiclePaperRenewal::class,
                'view_route' => 'admin.viewVehiclePaperRenewal',
            ],
            [
                'key' => 'new_vehicle_registration',
                'label' => 'New Vehicle Registration',
                'model' => VehicleRegistration::class,
                'view_route' => 'admin.viewNewVehicleRegistration',
            ],
            [
                'key' => 'change_of_ownership',
                'label' => 'Change of Ownership',
                'model' => ChangeOfOwnership::class,
                'view_route' => 'admin.viewChangeOfOwnership',
            ],
            [
                'key' => 'new_drivers_licence',
                'label' => "New Driver's Licence",
                'model' => NewDriverLicense::class,
                'view_route' => 'admin.viewNewDriverLicense',
            ],
            [
                'key' => 'drivers_licence_renewal',
                'label' => "Driver's Licence Renewal",
                'model' => DriverLicenseRenewal::class,
                'view_route' => 'admin.viewNewDriverLicenseRenewal',
            ],
            [
                'key' => 'international_drivers_licence',
                'label' => "International Driver's Licence",
                'model' => InternationalDriverLicense::class,
                'view_route' => 'admin.viewInternationalDriverlicense',
            ],
            [
                'key' => 'last_plate_number',
                'label' => 'Last Plate Number',
                'model' => DealerPlateNumber::class,
                'view_route' => 'admin.viewplateNumber',
            ],
            [
                'key' => 'other_permits',
                'label' => 'Other Permits',
                'model' => OtherPermit::class,
                'view_route' => 'admin.viewOtherPermit',
            ],
        ];

        $documents = new Collection();
        foreach ($services as $service) {
            $records = $service['model']::query()->get();

            foreach ($records as $record) {
                $fullName = trim(collect([
                    $record->firstname,
                    $record->middlename,
                    $record->lastname,
                ])->filter()->implode(' '));

                $documents->push((object) [
                    'service' => $service['key'],
                    'service_label' => $service['label'],
                    'process_id' => $record->process_id,
                    'process_type' => $record->process_type ?: $service['label'],
                    'applicant' => $record->fullname ?: ($fullName ?: null),
                    'email' => $record->user_email ?: $record->email ?: $record->emailaddress,
                    'payment_status' => $record->payment_status,
                    'amount' => $record->totalamount ?? $record->totalAmount ?? $record->amount,
                    'created_at' => $record->created_at,
                    'view_url' => route($service['view_route'], encrypt($record->id)),
                ]);
            }
        }

        $documents = $documents
            ->sortByDesc(fn ($document) => $document->created_at?->getTimestamp() ?? 0)
            ->values();

        $selectedService = $request->query('service', 'all');
        if ($selectedService !== 'all' && ! collect($services)->contains('key', $selectedService)) {
            $selectedService = 'all';
        }

        return view('admin.pages.processType.documents', compact('documents', 'services', 'selectedService'));
    }

    public function processVehiclePaperRenewal(){
        return redirect()->route('admin.processtype.index', ['service' => 'vehicle_licence_renewal']);
    }

    public function viewVehiclePaperRenewal($id){
        $items = VehiclePaperRenewal::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.viewVehiclePaperRenewal', compact('items'));
    }

    public function processNewVehicleRegistration(){
        return redirect()->route('admin.processtype.index', ['service' => 'new_vehicle_registration']);
    }

    public function viewNewVehicleRegistration($id){
        $items = VehicleRegistration::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.viewNewVehicleRegistration', compact('items'));
    }

    public function processChangeOfOwnership(){ 
        return redirect()->route('admin.processtype.index', ['service' => 'change_of_ownership']);
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
        return redirect()->route('admin.processtype.index', ['service' => 'new_drivers_licence']);
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
        return redirect()->route('admin.processtype.index', ['service' => 'drivers_licence_renewal']);
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
        return redirect()->route('admin.processtype.index', ['service' => 'international_drivers_licence']);
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
        return redirect()->route('admin.processtype.index', ['service' => 'last_plate_number']);
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
        return redirect()->route('admin.processtype.index', ['service' => 'other_permits']);
    }

    public function viewOtherPermit($id){
        $items = OtherPermit::find(decrypt($id));
        if (!$items) {
           return view('admin.404');
        }
        return view('admin.pages.processType.otherPermit.viewOtherPermit',compact('items'));
    }
        

}
