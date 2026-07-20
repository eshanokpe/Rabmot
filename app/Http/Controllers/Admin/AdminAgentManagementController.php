<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AgentDetailMessage;
use App\Mail\AgentEmailForgetPassword;
use App\Models\Agent;
use App\Models\AgentPasswordModel;
use App\Models\Order;
use App\Models\ProcessHistory;
use App\Models\Wallet;
use App\Models\WalletPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminAgentManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Agent::query();

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('fullname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_no', 'like', "%{$search}%");
            });
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        if ($approvalStatus = $request->query('approval_status')) {
            $query->where('approval_status', $approvalStatus);
        }

        $items = $query->latest()->paginate(20)->withQueryString();

        return view('admin.pages.agents.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pages.agents.create');
    }

    public function store(Request $request)
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
            $agentData = $request->only(['username', 'email', 'fullname', 'phone_no', 'location', 'gender']);
            $agentData['password'] = Hash::make($request->input('password'));
            $agentData['userType'] = 'agent';
            $agentData['status'] = 'active';
            $agentData['approval_status'] = 'approved';
            $agentData['approved_by'] = Auth::guard('admin')->user()->id;
            $agentData['approved_at'] = now();

            try {
                $sendMail = new AgentDetailMessage($agentData['email'], $agentData['fullname'], $agentData['username'], $request->input('password'));
                Mail::to($agentData['email'])->send($sendMail);
                Agent::create($agentData);
                return redirect()->back()->with('success', 'Created Successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Email not sending');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Agent Details failed');
        }
    }

    public function edit($id)
    {
        $items = Agent::find(decrypt($id));
        return view('admin.pages.agents.edit', compact('items'));
    }

    public function update(Request $request, $id)
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

    public function show($id)
    {
        $agent = Agent::find(decrypt($id));

        if (!$agent) {
            abort(404);
        }

        $orders = Order::where('user_id', $agent->id)
            ->where('user_email', $agent->email)
            ->where('userType', 'agent')
            ->latest()
            ->paginate(10, ['*'], 'orders_page');

        $processHistory = ProcessHistory::where('user_id', $agent->id)
            ->where('user_email', $agent->email)
            ->where('userType', 'agent')
            ->latest()
            ->get();

        $withdrawals = Wallet::where('user_id', $agent->id)
            ->where('user_email', $agent->email)
            ->where('userType', 'agent')
            ->latest()
            ->paginate(10, ['*'], 'withdrawals_page');

        $totalEarning = WalletPayment::where('user_id', $agent->id)
            ->where('user_email', $agent->email)
            ->where('userType', 'agent')
            ->sum('amount');

        $totalWithdrawn = Wallet::where('user_id', $agent->id)
            ->where('user_email', $agent->email)
            ->where('userType', 'agent')
            ->where('status', 2)
            ->sum('amount');

        $walletBalance = $totalEarning - $totalWithdrawn;

        return view('admin.pages.agents.show', compact(
            'agent', 'orders', 'processHistory', 'withdrawals',
            'totalEarning', 'totalWithdrawn', 'walletBalance'
        ));
    }

    public function activate($id)
    {
        $agent = Agent::find(decrypt($id));
        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found.');
        }
        $agent->status = 'active';
        $agent->save();

        return redirect()->back()->with('success', 'Agent activated successfully.');
    }

    public function suspend($id)
    {
        $agent = Agent::find(decrypt($id));
        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found.');
        }
        $agent->status = 'disable';
        $agent->save();

        return redirect()->back()->with('success', 'Agent suspended successfully.');
    }

    public function resetCredentials($id)
    {
        $agent = Agent::find(decrypt($id));
        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found.');
        }

        $token = Str::random(64);
        AgentPasswordModel::create([
            'email' => $agent->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        try {
            Mail::to($agent->email)->send(new AgentEmailForgetPassword($agent->email, $token));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Could not send the password reset email. Please try again.');
        }

        return redirect()->back()->with('success', "Password reset email sent to {$agent->email}.");
    }
}
