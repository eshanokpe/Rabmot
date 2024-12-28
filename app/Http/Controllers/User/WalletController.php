<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WalletPayment;
use App\Models\Notifications;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index(){
        $user = auth()->user();
        $id = $user->id;
        $fullname = $user->fullname;
        $email = $user->email;

        $items = Wallet::latest()->get();
        $totalWithdrawAmount = Wallet::where('user_id', $id)
        ->where('userType', 'user')
        ->where('status', 2)
        ->where('user_email', $email)->sum('amount');

        $totalEarning = WalletPayment::where('user_id', $id)
        ->where('userType', 'user')
        ->where('user_email', $email)->sum('amount');

        $walletBalance = $totalEarning - $totalWithdrawAmount;
        
        return view('user.pages.wallet', compact( 'items','totalEarning','totalWithdrawAmount','walletBalance')); 
    }
}
 