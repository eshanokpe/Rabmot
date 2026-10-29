<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AgentDetailMessage;
use App\Mail\AgentEmailForgetPassword;
use App\Models\Agent;
use App\Models\AgentCommissionTier;
use App\Models\AgentPasswordModel;
use App\Models\Order;
use App\Models\ProcessHistory;
use App\Models\Wallet;
use App\Models\WalletPayment;
use App\Services\AgentCommissionAuditLogger;
use App\Services\AgentReferralCommissionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminAgentManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Agent::with('commissionTier');

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
        $tiers = AgentCommissionTier::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.pages.agents.create', compact('tiers'));
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
            'commission_tier_id' => 'nullable|exists:agent_commission_tiers,id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $agentData = $request->only(['username', 'email', 'fullname', 'phone_no', 'location', 'gender']);
        $agentData['password'] = Hash::make($request->input('password'));
        $agentData['userType'] = 'agent';
        $agentData['status'] = 'active';
        $agentData['approval_status'] = 'approved';
        $agentData['approved_by'] = Auth::guard('admin')->user()->id;
        $agentData['approved_at'] = now();
        $agentData['referral_code'] = Agent::generateReferralCode();
        $agentData['commission_tier_id'] = $request->input('commission_tier_id');

        $agentData['referred_by'] = null;
        if ($request->filled('referral_code')) {
            $referringAgent = Agent::where('referral_code', $request->input('referral_code'))->first();
            if ($referringAgent) {
                $agentData['referred_by'] = $referringAgent->id;
            }
        }

        $agent = Agent::create($agentData);

        if ($agent->commissionTier) {
            (new AgentCommissionAuditLogger())->log(
                Auth::guard('admin')->user(),
                'agent_tier_assigned',
                "Tier \"{$agent->commissionTier->name}\" assigned to {$agent->fullname} ({$agent->username})",
                null,
                "{$agent->commissionTier->name} ({$agent->commissionTier->rate}%)",
                $agent->id,
                $agent->commissionTier->id
            );
        }

        try {
            Mail::to($agent->email)->send(new AgentDetailMessage(
                $agent->email,
                $agent->fullname,
                $agent->username,
                $request->input('password')
            ));
        } catch (\Throwable $e) {
            Log::warning('Agent welcome email failed.', [
                'agent_id' => $agent->id,
                'exception' => $e->getMessage(),
            ]);

            return redirect()->route('admin.agents')->with(
                'warning',
                'Agent created successfully, but the welcome email could not be sent. Check the mail settings and use Reset Credentials (Email) from the agent profile to send a password reset link.'
            );
        }

        return redirect()->route('admin.agents')->with('success', 'Agent created and welcome email sent successfully.');
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
            ->where('status', 'paid')
            ->sum('amount');

        $walletBalance = $totalEarning - $totalWithdrawn;

        $referredBy = $agent->referred_by ? Agent::find($agent->referred_by) : null;

        $referredAgents = Agent::where('referred_by', $agent->id)->latest()->get();

        $totalReferralCommission = WalletPayment::where('user_id', $agent->id)
            ->where('user_email', $agent->email)
            ->where('userType', 'agent')
            ->where('type', 'referral_commission')
            ->sum('amount');

        $commissionResolution = (new AgentReferralCommissionService())->resolveRateForAgent($agent);
        $tiers = AgentCommissionTier::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.pages.agents.show', compact(
            'agent', 'orders', 'processHistory', 'withdrawals',
            'totalEarning', 'totalWithdrawn', 'walletBalance',
            'referredBy', 'referredAgents', 'totalReferralCommission',
            'commissionResolution', 'tiers'
        ));
    }

    public function setCommissionTier(Request $request, $id)
    {
        $validated = $request->validate([
            'commission_tier_id' => 'nullable|exists:agent_commission_tiers,id',
        ]);

        $agent = Agent::findOrFail(decrypt($id));
        $admin = Auth::guard('admin')->user();
        $oldTier = $agent->commissionTier;
        $newTier = isset($validated['commission_tier_id'])
            ? AgentCommissionTier::findOrFail($validated['commission_tier_id'])
            : null;

        $agent->commission_tier_id = $newTier?->id;
        $agent->save();

        (new AgentCommissionAuditLogger())->log(
            $admin,
            $newTier ? 'agent_tier_assigned' : 'agent_tier_cleared',
            ($newTier ? "Tier \"{$newTier->name}\" assigned to " : 'Assigned tier cleared for ')
                . "{$agent->fullname} ({$agent->username})",
            $oldTier ? "{$oldTier->name} ({$oldTier->rate}%)" : null,
            $newTier ? "{$newTier->name} ({$newTier->rate}%)" : null,
            $agent->id,
            $newTier?->id
        );

        return redirect()->back()->with('success', $newTier
            ? "Commission tier \"{$newTier->name}\" assigned successfully."
            : 'Agent commission tier cleared.');
    }

    public function setOverride(Request $request, $id)
    {
        $validated = $request->validate([
            'override_rate' => 'required|numeric|min:0|max:100',
        ]);

        $agent = Agent::find(decrypt($id));
        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found.');
        }

        $admin = Auth::guard('admin')->user();
        $old = $agent->commission_override_rate;

        $agent->commission_override_rate = $validated['override_rate'];
        $agent->save();

        (new AgentCommissionAuditLogger())->log(
            $admin,
            'override_set',
            "Commission override for {$agent->fullname} ({$agent->username}) set to {$agent->commission_override_rate}%" . (is_null($old) ? '' : " (was {$old}%)"),
            $old !== null ? (string) $old : null,
            (string) $agent->commission_override_rate,
            $agent->id
        );

        return redirect()->back()->with('success', 'Commission override set.');
    }

    public function clearOverride($id)
    {
        $agent = Agent::find(decrypt($id));
        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found.');
        }

        $admin = Auth::guard('admin')->user();
        $old = $agent->commission_override_rate;

        $agent->commission_override_rate = null;
        $agent->save();

        (new AgentCommissionAuditLogger())->log(
            $admin,
            'override_cleared',
            "Commission override cleared for {$agent->fullname} ({$agent->username}); reverts to tier/base rate",
            $old !== null ? (string) $old : null,
            null,
            $agent->id
        );

        return redirect()->back()->with('success', 'Commission override cleared.');
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
