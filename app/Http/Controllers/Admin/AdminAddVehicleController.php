<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\AddVehicleRenewal;
use App\Models\AddVehicleOwnership;
use App\Models\AddVehicleRegistration;


class AdminAddVehicleController extends Controller
{
    public function addVehicleRenewal(){
        // $yearsofmake = Yearsofmake::all();
        $userEmail = User::all();
        $vehcileType = VehicleType::all();
        return view('admin.pages.addVehicle.addVehicleRenewal', compact('vehcileType','userEmail'));
    }

    public function storeVehicleRenewal(Request $request){
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
        $image->move(public_path('documents/vehiclerenewals'), $vhdocument);
        } else{ 
        $vhdocument = null;
        }

        if($request->hasFile('insurancepapers')){
        $image = $request->file('insurancepapers');
        $ipdocument = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('documents/vehiclerenewals'), $ipdocument);
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
        $hppdocument = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('documents/vehiclerenewals'), $hppdocument);
        }else{
        $hppdocument = null;
        }

        if($request->hasFile('statecarriagepermit')){
            $image = $request->file('statecarriagepermit');
            $scpdocument = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('documents/vehiclerenewals'), $scpdocument);
        }else{
            $scpdocument = null;
        }
        if($request->hasFile('midyearpermit')){
            $image = $request->file('midyearpermit');
            $mypdocument = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('documents/vehiclerenewals'), $mypdocument);
        }else{
            $mypdocument = null;
        }
        if($request->hasFile('localgovernmentpermit')){
            $image = $request->file('localgovernmentpermit');
            $lgpdocument = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('documents/vehiclerenewals'), $lgpdocument);
        }else{
            $lgpdocument = null;
        }
        if($request->hasFile('meansofid')){
            $image = $request->file('meansofid');
            $moiddocument = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('documents/vehiclerenewals'), $moiddocument);
        } else{
            $moiddocument = null;
        }
      
        $admin = auth('admin')->user(); 
        // dd($admin);
        $ownerdetails = User::where('email', $request->owneremail)->get()->first();
        $ownerID = $ownerdetails->id;
        
        $vehiclerenewal = new Addvehiclerenewal();
        $vehiclerenewal->user_id = $ownerID;
        $vehiclerenewal->userType = 'Admin';
        $vehiclerenewal->user_email= $admin->email;
        $vehiclerenewal->ownerfullname = $request->ownerfullname;
        $vehiclerenewal->owneremail = $request->owneremail;
        $vehiclerenewal->category = $request->category;
        $vehiclerenewal->vehiclemake = $request->vehiclemake;
        $vehiclerenewal->vehiclemodel = $request->vehiclemodel;
        $vehiclerenewal->year0fmake = $request->year_of_make;
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
        $vehiclerenewal->insurancepapers = 'vehiclerenewals/'.$ipdocument;
        $vehiclerenewal->roadworthinesspapers = 'vehiclerenewals/'.$rwpdocument;
        $vehiclerenewal->hackneypermitpaper = 'vehiclerenewals/'.$hppdocument;
        $vehiclerenewal->statecarriagepermit = 'vehiclerenewals/'.$scpdocument;
        $vehiclerenewal->midyearpermit = 'vehiclerenewals/'.$mypdocument;
        $vehiclerenewal->localgovernmentpermit = 'vehiclerenewals/'.$lgpdocument;
        $vehiclerenewal->meansofid = 'vehiclerenewals/'.$moiddocument;
        $saved = $vehiclerenewal->save(); 

        if($saved){
            return redirect()->back()->withSuccess('New Vehicle Renewal has been successfully created.');

        }else{
            return redirect()->back()->withError('Somthing went wrong in saving Vehicle Renewal data.');
        }
    }

    public function addVehicleNewRegistration(){
        $vehicleList = VehicleType::all();
        $userEmail = User::all();
        return view('admin.pages.addVehicle.addNewVehicleRegistration', compact('vehicleList', 'userEmail'));
    }

    public function storeVehicleNewRegistration(Request $request){
      
        $request->validate([
            'custompapers' => 'required', 
            'custompapers.*' => 'mimes:jpeg,docx,doc,pdf,xls,xlsx,jpg,jpeg,png|max:4024', 
            'meansofid' => 'required|mimes:jpeg,docx,doc,pdf,jpg,png|max:2024', 
        ],[
            'custompapers.required' => 'The Custom Papers is required',
            'meansofid.required' => 'The Means of ID is required',
        ]);
        $admin = auth('admin')->user();
       
        
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
        $ownerdetails = User::where('email', $request->owneremail)->get()->first();
        $ownerID = $ownerdetails->id;
        $saved = AddVehicleRegistration::create([
            // 'user_id'=>  $admin->id,
            'user_id'=>  $ownerID,
            'userType' => 'Admin',
            'user_email' => $admin->email,
            'ownerfullname' => $request->ownerfullname,
            'owneremail' => $request->owneremail,
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
            'custompapers' => 'vehicleRegistration/'.$custompapers,
            'meansofid' => 'vehicleRegistration/'.$moiddocument,
        ]);
            
        if($saved){
            return redirect()->back()->withSuccess('New Vehicle Registration has been created Successfully');

        }else{
            return redirect()->back()->withError('Somthing went wrong in saving Vehicle Renewal data.');
        }
    }

    public function addVehicleChangeOfOwnership(){
        $vehicleList = VehicleType::all();
        $userEmail = User::all();
        return view('admin.pages.addVehicle.addChangeofownership', compact('vehicleList','userEmail'));
    }

    public function storeVehicleChangeOfOwnership(Request $request){
        try{
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
                $image->move(public_path('documents/vehicleOwnership'), $vehiclelicensepapers);
            }else{
                $vehiclelicensepapers = null;
            }
        
            if($request->hasFile('proofofownership')){
                $image = $request->file('proofofownership');
                $proofofownership = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('documents/vehicleOwnership'), $proofofownership);
            }else{
                $proofofownership = null;
            }
  
            if($request->hasFile('agreement')){
                $image = $request->file('agreement');
                $agreement = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('documents/vehicleOwnership'), $agreement);
            }else{
                $agreement = null;
            }
        
            if($request->hasFile('meansofid')){
                $image = $request->file('meansofid');
                $meansofid = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('documents/vehicleOwnership'), $meansofid);
            }else{
                $meansofid = null;
            }
            $admin = auth('admin')->user(); 
            $ownerdetails = User::where('email', $request->owneremail)->get()->first();
            $ownerID = $ownerdetails->id;
       
            $vehicleOwnership = new AddVehicleOwnership();
            $vehicleOwnership->user_id =  $ownerID; 
            $vehicleOwnership->userType = 'Admin';
            $vehicleOwnership->user_email = $admin->email;
            $vehicleOwnership->ownersfullname = $request->ownerfullname;
            $vehicleOwnership->ownersemail = $request->owneremail;
            $vehicleOwnership->category = $request->category;
            $vehicleOwnership->vehiclemake = $request->vehiclemake;
            $vehicleOwnership->vehiclemodel = $request->vehiclemodel;
            $vehicleOwnership->yearofmake = $request->year_of_make;
            $vehicleOwnership->platenumber = $request->platenumber;
            $vehicleOwnership->chassisnumber = $request->chassisnumber;
            $vehicleOwnership->enginenumber = $request->enginenumber;
            $vehicleOwnership->vehiclecolor = $request->vehiclecolor;
            $vehicleOwnership->vehiclepapername = $request->vehiclelicense;
            $vehicleOwnership->vehicledocumentname = $request->vehicledocumentname;
            $vehicleOwnership->registeredaddressofvehicle = $request->registeredaddressofvehicle;
            $vehicleOwnership->ownerfullname = $request->ownerfullname;
            $vehicleOwnership->ownersNIN = $request->ownerNIN;
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
            $saved = $vehicleOwnership->save(); 
        
            if($saved){
                return redirect()->back()->withSuccess('New Ownership Renewal has been successfully created.');
        
            }else{
                return redirect()->back()->withError('Somthing went wrong in saving Vehicle Renewal data.');
            }
        }catch(Exception $e){
            return redirect()->back()->withError('Somthing went wrong'.$e->getMessage());
        }
    }
}
