<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminLoginController extends Controller
{  
    public function showLoginForm()
    {
        return view('auth.admin.admin-login'); 
    } 

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();

            if (!$admin->isActive()) {
                Auth::guard('admin')->logout();
                return back()->withErrors(['error' => 'Your admin account has been deactivated. Please contact a super admin.']);
            }

            $admin->last_login = now();
            $admin->login_ip = $request->ip();
            $admin->save();

            return redirect()->intended(route('admin.index'));
        }


        return back()->withErrors(['error' => 'Invalid Admin Credentials']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
