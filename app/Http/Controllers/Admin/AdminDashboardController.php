<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\ProcessHistory;
use App\Models\Agent;
use App\Models\User;
use App\Models\FAQs;
use App\Models\ContactMessage;
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
use App\Models\PaymentModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminDashboardController extends Controller
{
    public function index()
    { 
        $user = Auth::guard('admin')->user();
        $userId = $user->id;
        $userEmail = $user->email;
        $userDetails = User::where('id', $user->id)->first();

        // --------------------------
        // 📊 NEW TOP STATS
        // --------------------------
        // Total Orders Today vs Yesterday
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $ordersToday = ProcessHistory::whereDate('created_at', $today)->count();
        $ordersYesterday = ProcessHistory::whereDate('created_at', $yesterday)->count();
        $ordersTodayDelta = $ordersYesterday > 0 
            ? round((($ordersToday - $ordersYesterday) / $ordersYesterday) * 100, 1) 
            : 0;

        // Total Orders This Month vs Last Month
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $ordersThisMonth = ProcessHistory::whereBetween('created_at', [$thisMonth, Carbon::now()])->count();
        $ordersLastMonth = ProcessHistory::whereBetween('created_at', [$lastMonth, $thisMonth->copy()->subDay()])->count();
        $ordersMonthDelta = $ordersLastMonth > 0 
            ? round((($ordersThisMonth - $ordersLastMonth) / $ordersLastMonth) * 100, 1) 
            : 0;

        // Revenue This Month
        $revenueThisMonth = PaymentModel::where('status', 'Successful')
            ->whereBetween('created_at', [$thisMonth, Carbon::now()])
            ->sum('amount');
        $revenueLastMonth = PaymentModel::where('status', 'Successful')
            ->whereBetween('created_at', [$lastMonth, $thisMonth->copy()->subDay()])
            ->sum('amount');
        $revenueDelta = $revenueLastMonth > 0 
            ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 1) 
            : 0;

        // Pending Orders
        $pendingOrders = ProcessHistory::where('status', 0)->count();

        // Active Users + Agents
        $totalUsers = User::where('status', 1)->count();
        $totalAgents = Agent::where('status', 1)->count();
        $activeUsersTotal = $totalUsers + $totalAgents;

        // Documents Expiring in 30 days
        $expiryThreshold = Carbon::now()->addDays(30);
        $expiringDocs = VehiclePaperRenewal::whereDate('created_at', '<=', $expiryThreshold)->count();

        // --------------------------
        // Existing Stats
        // --------------------------
        $items = ProcessHistory::where('status',0)->orderBy('created_at', 'asc')->get();
        $countprocesshistory = ProcessHistory::count();
        $countdelivered = ProcessHistory::where('status', 4)->count();
        $countdeliveryinprogress = ProcessHistory::where('status', 3)->count();
        $countreadyfordelivery = ProcessHistory::where('status', 2)->count();
        $countprocessing = ProcessHistory::where('status', 1)->count();
        $countpending = $pendingOrders;
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
                'counInternationadriverlicense','counVehiclePlatenumber','counOtherpermit',

                // New stats
                'ordersToday', 'ordersTodayDelta',
                'ordersThisMonth', 'ordersMonthDelta',
                'revenueThisMonth', 'revenueDelta',
                'activeUsersTotal', 'expiringDocs'
            )
        );
    }

    // --- Keep all your existing methods below ---
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
            return redirect()->route('admin.users')->with('success', 'User account deleted successfully');
        }
        $item->status = $request->input('status');
        $item->save();
        return redirect()->back()->with('success', 'User status updated successfully');
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
            return redirect()->back()->withInput()->withErrors($validator);
        }
 
        try {
            FAQs::create($request->only(['question', 'answer']));
            return redirect()->back()->with('success', 'FAQ added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add FAQ.');
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
        return redirect()->back()->with('success', 'FAQ updated successfully');
    }

    public function settings(){
        return view('admin.pages.account.password');
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