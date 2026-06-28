<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\ProcessHistory;
use App\Models\User;
use App\Models\FAQs;
use App\Models\ContactMessage;
use App\Models\Agent;
use App\Models\AddVehicleRenewal;
use App\Models\WalletPayment;
use App\Models\VehiclePaperRenewal;
use App\Models\VehicleRegistration;
use App\Models\ChangeofOwnershipPrice;
use App\Models\NewDriverLicense;
use App\Models\DriverLicenseRenewal;
use App\Models\InternationalDriverLicense;
use App\Models\DealerPlateNumber;
use App\Models\OtherPermit;
use Illuminate\Support\Facades\Validator;
use App\Mail\AgentDetailMessage;
 
class AdminDashboardController extends Controller
{
   // public function __construct()
   // {
   //     $this->middleware('admin');
   // }
   
    public function index()
    { 
      $user = Auth::guard('admin')->user();
      $userId = $user->id;
      $userEmail = $user->email;
         
      $userDetails = User::where('id', $user->id)->first();
      $items = ProcessHistory::where('status',0)->latest()->get();
      $countprocesshistory = ProcessHistory::count();
      $countdelivered = ProcessHistory::where('status', 4)->count();
      $countdeliveryinprogress = ProcessHistory::where('status', 3)->count();
      $countreadyfordelivery = ProcessHistory::where('status', 2)->count();
      $countprocessing = ProcessHistory::where('status', 1)->count();
      $countpending = ProcessHistory::where('status', 0)->count();
      $countVehiclepaperrenewal = VehiclePaperRenewal::count();
      $countVehiclepaperrenewal = VehiclePaperRenewal::count();
      $countVehicleRegistration = VehicleRegistration::count();
      $countChangeofownership = ChangeofOwnershipPrice::count();
      $countNewdriverlicense = NewDriverLicense::count();
      $countDriverlicenserenewal = DriverLicenseRenewal::count();
      $counInternationadriverlicense = InternationalDriverLicense::count();
      $counVehiclePlatenumber= DealerPlateNumber::count();
      $counOtherpermit= OtherPermit::count();
     
      return view('admin.dashboard', 
         compact(
            'user','userDetails',
            'items','countprocesshistory', 'countdelivered','countdeliveryinprogress',
            'countreadyfordelivery','countprocessing','countpending', 'countVehiclepaperrenewal',
            'countVehicleRegistration','countChangeofownership','countNewdriverlicense','countDriverlicenserenewal',
            'counInternationadriverlicense','counVehiclePlatenumber','counOtherpermit'
         )
      );
   }

   public function getusers(){
      $items = User::latest()->get();
      return view('admin.pages.users.index', compact('items'));
   }
   
   public function editUser($id){
      $items = User::find(decrypt($id));
      return view('admin.pages.users.edit', compact('items'));
   }
   
   public function updateUserStatus(Request $request, $id)
   {
      $item = User::find($id);
      if ($request->input('status') == 'delete') {
         $item->delete();
         return redirect()->route('admin.users')->with('success', 'User Status account deleted successfully');
      }
      $item->status = $request->input('status');
      $item->save();
    
      return redirect()->back()->with('success', 'User Status account updated successfully');
   }

   public function getAgent(){
      $items = Agent::latest()->get();
      return view('admin.pages.agents.index', compact('items'));
   }

   public function createAgent(){
      return view('admin.pages.agents.create');
   }

   public function postcreateAgent(Request $request)
   {
      $validator = Validator::make($request->all(), [
          'username' => 'required',
          'email' => 'required|string|email|max:255|unique:agents,email', 
          'fullname' => 'required',
          'phone_no' => 'nullable',
          'password' => 'required|string|min:7',
          'cpassword' => 'required|same:password',
          'location' => 'nullable',
          'gender' => 'required',
      ]);
     
      if ($validator->fails()) {
          return redirect()
              ->back()
              ->withInput()
              ->withErrors($validator);
      }
  
      try {
          // Create a new Agent instance
          $agentData = $request->only(['username', 'email', 'fullname', 'phone_no', 'location', 'gender']);
          $agentData['password'] = Hash::make($request->input('password'));
          $agentData['userType'] = 'agent';
          $agentData['status'] = 1;
          
          // Send email notification
          try {
              $sendMail = new AgentDetailMessage($agentData['email'], $agentData['fullname'], $agentData['username'], $request->input('password'));
              Mail::to($agentData['email'])->send($sendMail);
              $agent = Agent::create($agentData);
              return redirect()->back()->with('success', 'Created Successfully.');
          } catch (\Exception $e) {
              return redirect()->back()->with('error', 'Email not sending');
          }
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Agent Details failed');
      }
  
   }

   public function editAgent($id){
      $items = Agent::find(decrypt($id));
      return view('admin.pages.agents.edit', compact('items'));
   }

   public function updateAgent(Request $request, $id)
   {
      $item = Agent::find($id);
  
      if ($request->input('status') == 'delete') {
           $item->delete();
          return redirect()->route('admin.agents')->with('success', 'Agent account deleted successfully');
      } 
      $item->username = $request->input('username');
      $item->email = $request->input('email');
      $item->fullname = $request->input('fullname');
      $item->phone_no = $request->input('phone_no');
      $item->location = $request->input('location');
      $item->gender = $request->input('gender');
  
      if ($request->filled('password')) {
          $item->password = encrypt($request->input('password'));
      }
  
      $item->status = $request->input('status');
      $item->save();
      return redirect()->back()->with('success', 'Agent account updated successfully');
   }

   public function contactMessage()
   {
      $contactMsgs = ContactMessage::latest()->get();
      return view('admin.pages.contactMessage.index', compact('contactMsgs'));
   }
   
   public function showContactMessage($id)
   {
      $items = ContactMessage::find(decrypt($id));
      return view('admin.pages.contactMessage.show', compact('items'));
   }

   public function showFAQ(){
      $data = FAQs::latest()->get();
      return view('admin.pages.faqs.index', compact('data'));
   }

   public function addFaqQuestion(){
      return view('admin.pages.faqs.add');
   }

   public function addFaqQuestionPost(Request $request){
      $validator = Validator::make($request->all(), [
         'question' => 'required',
         'answer' => 'required',
     ]);
    
     if ($validator->fails()) {
         return redirect()
             ->back()
             ->withInput()
             ->withErrors($validator);
     }
 
     try {
         // Create a new Agent instance
         $faqData = $request->only(['question', 'answer']);
         
         FAQs::create($faqData);
         return redirect()->back()->with('success', 'Created Successfully.');
         
     } catch (\Exception $e) {
         return redirect()->back()->with('error', 'Add Details failed');
     }
   }

   public function editFaqQuestion($id){
      $data = FAQs::find(decrypt($id));
      return view('admin.pages.faqs.edit', compact('data'));
   }

   public function updateFaqQuestion(Request $request, $id){
      $item = FAQs::find($id);
  
     
      $item->question = $request->input('question');
      $item->answer = $request->input('answer');

      $item->save();
      return redirect()->back()->with('success', 'FAQs updated successfully');
   }

   public function settings(){  
      return view('admin.pages.settings.index');
   }

   public function postSettings(Request $request) 
   {
     
      $validator = Validator::make($request->all(), [
         'oldpassword' => 'required|string',
         'password' => 'required|string|confirmed',
     ]);
      if ($validator->fails()) {
         return redirect()
             ->back()
             ->withInput()
             ->withErrors($validator);
     }

      $user = auth('admin')->user();
      if (!Hash::check($request->oldpassword, $user->password)) {
         throw ValidationException::withMessages(['oldpassword' => 'The provided old password is incorrect.']);
      }

      $user->update([
         'password' => Hash::make($request->password),
      ]);

      return redirect()->back()->with('success', 'Password changed successfully!');
   }

 

}
