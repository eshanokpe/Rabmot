<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\WalletPayment;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function index()
    {
        $agent = Auth::guard('agent')->user();

        if (!$agent->referral_code) {
            $agent->referral_code = Agent::generateReferralCode();
            $agent->save();
        }

        $referralLink = route('agent.register') . '?ref=' . $agent->referral_code;

        $referredAgents = Agent::where('referred_by', $agent->id)->latest()->get();

        $totalReferralCommission = WalletPayment::where('user_id', $agent->id)
            ->where('user_email', $agent->email)
            ->where('userType', 'agent')
            ->where('type', 'referral_commission')
            ->sum('amount');

        return view('agent.pages.referral', compact('agent', 'referralLink', 'referredAgents', 'totalReferralCommission'));
    }
}
