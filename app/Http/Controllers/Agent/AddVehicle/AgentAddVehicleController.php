<?php

namespace App\Http\Controllers\Agent\AddVehicle;
use Carbon\Carbon; 
use Auth;
use Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleType;
use App\Models\AddVehicleRenewal;
use App\Models\AddVehicleOwnership;
use App\Models\AddVehicleRegistration;

class AgentAddVehicleController extends Controller
{
    public function index()
    {   
        $data['user'] = Auth::guard('agent')->user();
        $data['userId'] = $data['user']->id;
        $data['userEmail'] = $data['user']->email;
        return view('agent.pages.addVehicle.index', $data);
    }

    public function addvehiclerenewal()
    {
        $data['user'] = Auth::guard('agent')->user();
        $data['vehicleList'] = VehicleType::all();
        return view('agent.pages.addVehicle.addvehiclerenewal', $data);
    } 

    public function postaddvehiclerenewal(Request $request){
        try{
            $request->validate([
                'vehiclelicensepapers' => 'mimes:jpeg,docx,pdf,doc,jpg,png|max:2024',
                'insurancepapers' => 'mimes:jpeg,jpg,docx,pdf,doc,png|max:2024',
                'roadworthinesspapers' => 'mimes:jpeg,docx,pdf,doc,jpg,png|max:2024', 
                'meansofid' => 'mimes:jpeg,docx,pdf,doc,jpg,png|max:2024', 
        
            ],[ 
                
                'vehiclelicensepapers.mimes' => 'Upload the right File Format (jpeg,jpg,docx,doc,pdf,png) ',
                'insurancepapers.mimes' => 'Upload the right File Format (jpeg,jpg,docx,doc,pdf,png) ',
                'roadworthinesspapers.mimes' => 'Upload the right FFile Format (jpeg,jpg,docx,doc,pdf,png) ormat',
                'meansofid.mimes' => ' Upload the right File Format (jpeg,jpg,docx,doc,pdf,png) ',
            ]); 
 
            if($request->hasFile('vehiclelicensepapers')){
                $image = $request->file('vehiclelicensepapers');
                $vhdocument = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('document/vehiclerenewals'), $vhdocument);
                //$path = $vhdocument->store('public/vehiclerenewals');
            } else{ 
                $vhdocument = null;
            }
            if($request->hasFile('insurancepapers')){
                $image = $request->file('insurancepapers');
                $ipdocument = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('document/vehiclerenewals'), $ipdocument);
            } else{
                $ipdocument = null;
            }
            if($request->hasFile('roadworthinesspapers')){
                $image = $request->file('roadworthinesspapers');
                $rwpdocument = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('documents/vehiclerenewals'), $rwpdocument);
            }else{  
                $rwpdocument = null; 
            }
            if($request->hasFile('hackneypermitpaper')){
                $image = $request->file('hackneypermitpaper');
                $hackneypermitpaper = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('documents/vehiclerenewals'), $hackneypermitpaper);
            }else{
                $hackneypermitpaper = null;
            }
            if($request->hasFile('statecarriagepermit')){
                    $image = $request->file('statecarriagepermit');
                    $statecarriagepermit = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('documents/vehiclerenewals'), $statecarriagepermit);
            }else{
                    $statecarriagepermit = null;
            }
            if($request->hasFile('midyearpermit')){
                    $image = $request->file('midyearpermit');
                    $midyearpermit = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('documents/vehiclerenewals'), $midyearpermit);
            }else{
                    $midyearpermit = null;
            }
            if($request->hasFile('localgovernmentpermit')){
                    $image = $request->file('localgovernmentpermit');
                    $localgovernmentpermit = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('documents/vehiclerenewals'), $localgovernmentpermit);
                }else{
                    $localgovernmentpermit = null;
            }
            if($request->hasFile('meansofid')){
                    $image = $request->file('meansofid'); 
                    $moiddocument = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('documents/vehiclerenewals'), $moiddocument);
            } else{
                    $moiddocument = null;
            }
       
            $admin = Auth::guard('agent')->user();
            $vehiclerenewal = new AddVehicleRenewal();
            $vehiclerenewal->user_id = $admin->id;
            $vehiclerenewal->userType = 'agent';
            $vehiclerenewal->user_email= $admin->email;
            $vehiclerenewal->ownerfullname = $request->ownerfullname;
            $vehiclerenewal->owneremail = $request->owneremail;
            $vehiclerenewal->category = $request->category;
            $vehiclerenewal->vehiclemake = $request->vehiclemake;
            $vehiclerenewal->vehiclemodel = $request->vehiclemodel;
            $vehiclerenewal->year0fmake = $request->year0fmake;
            $vehiclerenewal->platenumber = $request->platenumber;
            $vehiclerenewal->chassisnumber = $request->chassisnumber;
            $vehiclerenewal->enginenumber = $request->enginenumber;
            $vehiclerenewal->vehiclecolor = $request->vehiclecolor;
            $vehiclerenewal->vehiclename = $request->vehiclename;
            $vehiclerenewal->vehicledocumentname = $request->vehicledocumentname;
            $vehiclerenewal->ownersphonenumber = $request->ownersphonenumber;
            $vehiclerenewal->registeredaddressofvehicle = $request->registeredaddressofvehicle;
            $vehiclerenewal->emailAddress = $request->emailAddress;
            $vehiclerenewal->vehiclelicenseexpiry = $request->vehiclelicenseexpiry;
            $vehiclerenewal->insuranceexpiry = $request->insuranceexpiry;
            $vehiclerenewal->roadworthinessexpiry = $request->roadworthinessexpiry;
            $vehiclerenewal->hackneypermitexpiry = $request->hackneypermitexpiry;
            $vehiclerenewal->statecarriagepermitexpiry = $request->statecarriagepermitexpiry;
            $vehiclerenewal->hackneydutypermitexpiry = $request->hackneydutypermitexpiry;
            $vehiclerenewal->localgovernmentpermitexpiry = $request->localgovernmentpermitexpiry;
 
            $vehiclerenewal->vehiclelicensepapers = 'vehiclerenewals/'.$vhdocument;
            $vehiclerenewal->insurancepapers =  'vehiclerenewals/'.$ipdocument;
            $vehiclerenewal->roadworthinesspapers = 'vehiclerenewals/'.$rwpdocument;
            $vehiclerenewal->hackneypermitpaper = 'vehiclerenewals/'.$hackneypermitpaper;
            $vehiclerenewal->statecarriagepermit = 'vehiclerenewals/'.$statecarriagepermit;
            $vehiclerenewal->midyearpermit = 'vehiclerenewals/'.$midyearpermit;
            $vehiclerenewal->localgovernmentpermit = 'vehiclerenewals/'.$localgovernmentpermit;
            $vehiclerenewal->meansofid = 'vehiclerenewals/'.$moiddocument;

            $saved = $vehiclerenewal->save(); 
 
            if($saved){
                return redirect()->back()->withSuccess('New Vehicle Renewal has been successfully created.');
        
            }else{
                return redirect()->back()->withError('Somthing went wrong in saving Vehicle Renewal data.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
        }
    }

    public function addVehicleRegistration(){
        $data['user'] = Auth::guard('agent')->user();
        $data['vehicleList'] = VehicleType::all();
        return view('agent.pages.addVehicle.addvehicleregistration', $data);
    }

    public function postAddVehicleRegistration(Request $request){
        try{

            $request->validate([
                'custompapers' => 'required', 
                'custompapers.*' => 'mimes:jpeg,docx,doc,pdf,xls,xlsx,jpg,jpeg,png|max:4024', 
                'meansofid' => 'required|mimes:jpeg,docx,doc,pdf,jpg,png|max:2024', 
            ],[
                'custompapers.required' => 'The Custom Papers is required',
                'meansofid.required' => 'The Means of ID is required',
            ]);
            $admin = Auth::guard('agent')->user();
        
            if($request->hasFile('meansofid')){
                $image = $request->file('meansofid');
                $moiddocument = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('documents/vehicleRegistration'), $moiddocument);
            }  
            if($request->hasFile('custompapers')){
                $image = $request->file('custompapers');
                $custompapers = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('documents/vehicleRegistration'), $custompapers);
            }  
            AddVehicleRegistration::create([
                'user_id'=>  $admin->id,
                'userType' => 'agent',
                'user_email' => $admin->email,
                'ownerfullname' => $request->ownerfullname,
                'owneremail' => $request->owneremail,
                'category' => $request->category,
                'vehiclemake' => $request->vehiclemake,
                'vehiclemodel' => $request->vehiclemodel,
                'year_of_make' => $request->year0fmake,
                'chassisnumber' => $request->chassisnumber,
                'enginenumber' => $request->enginenumber,
                'vehiclecolor' => $request->vehiclecolor,
                'applicantfullname' => $request->applicantfullname,
                'applicantNIN'=> $request->applicantNIN,
                'residentialaddress' => $request->residentialaddress,
                'phonenumber' => $request->phonenumber,
                'emailaddress' => $request->emailaddress,
                'gender' => $request->gender,
                'occupation' => $request->occupation,
                'dateofbirth' => $request->dateofbirth,
                'maritalstatus' => $request->maritalstatus,
                'state' => $request->state,
                'custompapers' => 'vehicleRegistration/'.$custompapers,
                'meansofid' => 'vehicleRegistration/'.$moiddocument,
                'created_date' => Carbon::now()->format('d F Y'),
                'created_month' => Carbon::now()->format('F'),
                'created_year' => Carbon::now()->format('Y'),
                'created_at' => Carbon::now(),
            ]);
            return redirect()->back()->with('success', 'New Vehicle Registration has been created Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
        }
    }

    public function addvehicleownership()
    {
        $data['user'] = Auth::guard('agent')->user();
        $data['vehicleList'] = VehicleType::all();
        return view('agent.pages.addVehicle.addvehicleownership', $data);
    }

    public function postaddchangeownership(Request $request){
      
        $request->validate([
           'vehiclelicensepapers' => 'mimes:jpeg,docx,doc,jpg,png|max:2024', 
           'insuranceexpiry.required' => '|mimes:jpeg,docx,doc,jpg,png|max:2024',
           'roadworthinessexpiry.required' => 'mimes:jpeg,docx,doc,jpg,png|max:2024',
           'statecarriagepermitexpiry.required' => 'mimes:jpeg,docx,doc,jpg,png|max:2024',          
       ],[
           'vehiclelicensepapers.mimes' => 'Please upload the correct file format.',
           'proofofownership.mimes' => 'Please upload the correct file format.',
           'agreement.mimes' => 'Please upload the correct file format.',
           'meansofid.mimes' => 'Please upload the correct file format.',
       ]);
  
       if($request->hasFile('vehiclelicensepapers')){
           $image = $request->file('vehiclelicensepapers');
           $vehiclelicensepapers = time() . '_' . $image->getClientOriginalName();
           $image->move(public_path('documents/vehicleownership'), $vehiclelicensepapers);
       }else{
           $vehiclelicensepapers = null;
       }
  
       if($request->hasFile('proofofownership')){
           $image = $request->file('proofofownership');
           $proofofownership = time() . '_' . $image->getClientOriginalName();
           $image->move(public_path('documents/vehicleownership'), $proofofownership);
       }else{
           $proofofownership = null;
       }
  
       if($request->hasFile('agreement')){
           $image = $request->file('agreement');
           $agreement = time() . '_' . $image->getClientOriginalName();
           $image->move(public_path('documents/vehicleownership'), $agreement);
       }else{
           $agreement = null;
       }
  
       if($request->hasFile('meansofid')){
           $image = $request->file('meansofid');
           $meansofid = time() . '_' . $image->getClientOriginalName();
           $image->move(public_path('documents/vehicleownership'), $meansofid);
       }else{
           $meansofid = null;
       }
       $agent = Auth::guard('agent')->user();
       try{
          
           $vehicleOwnership = new AddVehicleOwnership();
           $vehicleOwnership->user_id =  $agent->id;
           $vehicleOwnership->userType =  'agent';
           $vehicleOwnership->user_email = $agent->email;
           $vehicleOwnership->ownersfullname = $request->ownerfullname;
           $vehicleOwnership->ownersemail = $request->owneremail;
           $vehicleOwnership->ownersNIN = $request->ownersNIN;
           $vehicleOwnership->category = $request->category;
           $vehicleOwnership->vehiclemake = $request->vehiclemake;
           $vehicleOwnership->vehiclemodel = $request->vehiclemodel;
           $vehicleOwnership->yearofmake = $request->yearofmake;
           $vehicleOwnership->platenumber = $request->platenumber;
           $vehicleOwnership->chassisnumber = $request->chassisnumber;
           $vehicleOwnership->enginenumber = $request->enginenumber;
           $vehicleOwnership->vehiclecolor = $request->vehiclecolor;
           $vehicleOwnership->vehiclepapername = $request->vehiclelicense;
           $vehicleOwnership->vehicledocumentname = $request->vehicledocumentname;
           $vehicleOwnership->registeredaddressofvehicle = $request->registeredaddressofvehicle;
           $vehicleOwnership->ownerfullname = $request->ownerfullname;
           $vehicleOwnership->address = $request->address;
           $vehicleOwnership->phonenumber = $request->phonenumber;
           $vehicleOwnership->emailaddress = $request->emailaddress;
           $vehicleOwnership->gender = $request->gender;
           $vehicleOwnership->occupation = $request->occupation;
           $vehicleOwnership->vehiclelicenseexpiry = $request->vehiclelicenseexpiry;
           $vehicleOwnership->insuranceexpiry = $request->insuranceexpiry;
           $vehicleOwnership->roadworthinessexpiry = $request->roadworthinessexpiry;
           $vehicleOwnership->hackneypermitexpiry = $request->hackneypermitexpiry;
           $vehicleOwnership->statecarriagepermitexpiry = $request->statecarriagepermitexpiry;
           $vehicleOwnership->midyearpermit = $request->midyearpermit;
           $vehicleOwnership->localgovernmentpermitexpiry = $request->localgovernmentpermitexpiry;
           $vehicleOwnership->vehiclelicensepapers = 'vehicleOwnership/'.$vehiclelicensepapers;
           $vehicleOwnership->proofofownership = 'vehicleOwnership/'.$proofofownership;
           $vehicleOwnership->agreement = 'vehicleOwnership/'.$agreement;
           $vehicleOwnership->meansofid = 'vehicleOwnership/'.$meansofid;
           $vehicleOwnership->save();
           return redirect()
           ->back()
           ->with('success', 'New Vehicle Ownership has been created Successfully');
        } catch (\Exception $e) {
              return redirect()
                  ->back()
                  ->withInput()
                  ->with('error', $e->getMessage());
        }
    }

}
