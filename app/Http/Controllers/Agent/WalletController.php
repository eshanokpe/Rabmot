<?php

namespace App\Http\Controllers\Agent;
use Auth;
use App\Models\Wallet;
use App\Models\WalletPayment;
use App\Models\Notifications;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index(){
        $agent = auth('agent')->user();
        $id = $agent->id;
        $fullname = $agent->fullname;
        $email = $agent->email;

        $items = Wallet::latest()->get();
        $totalWithdrawAmount = Wallet::where('user_id', $id)
        ->where('userType', 'agent')
        ->where('status', 2)
        ->where('user_email', $email)->sum('amount');

        $totalEarning = WalletPayment::where('user_id', $id)
        ->where('userType', 'agent')
        ->where('user_email', $email)->sum('amount');

        $walletBalance = $totalEarning - $totalWithdrawAmount;
        
        return view('agent.pages.wallet', compact( 'items','totalEarning','totalWithdrawAmount','walletBalance')); 
    }

    public function create(Request $request)
    {
        $agent =  Auth::guard('agent')->user();
        $id = $agent->id;
        $fullname = $agent->fullname;
        $email = $agent->email;

        $items = Wallet::latest()->get();
        $totalWithdrawAmount = Wallet::where('user_id', $id)
        ->where('userType', 'agent')
        ->where('status', 2)
        ->where('user_email', $email)->sum('amount');

        $totalEarning = WalletPayment::where('user_id', $id)
        ->where('userType', 'agent')
        ->where('user_email', $email)->sum('amount');

        $amount = $request->amount;

        $walletBalance = $totalEarning - $totalWithdrawAmount;
        if ($amount > $walletBalance){
            return redirect()->back()->with('error', 'Insufficient Wallet Balance');
        }
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'bank' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
        ]);

        // For example, saving to a database:
        $wallet = Wallet::create([
            'user_id' => $id,
            'user_email' => $email,
            'userType' => 'agent',
            'amount' => $validatedData['amount'],
            'bank' => $validatedData['bank'],
            'account_number' => $validatedData['account_number'],
            'account_name' => $validatedData['account_name'],
            'status' => 0
        ]);
        $notification = [
            'user_id' => $id,
            'user_email' => $email,
            'fullname' => $fullname,
            'userType' => 'agent',
            'title'=>'Agent Withdrawal',
            'message' => 'An agent has submitted a withdrawal request',
        ];

        Notifications::create($notification);

        return redirect()->back()->with('success', 'Withdrawal in progress, will be process by Admin');
    }
}
