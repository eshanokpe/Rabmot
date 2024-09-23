<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB; 
use App\Models\Agent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\PasswordModel;
use Mail;
use Carbon\Carbon;
use App\Mail\AgentEmailForgetPassword;


class AgentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.agent.agent-login'); // Create a view for the agent login form
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'agent'])) {
            return redirect()->route('agent.dashboard');
        }

        return back()->withErrors(['error' => 'Invalid Agent Credentials']);
    }

    public function forgotpassword()
    {
        return view('auth.agent.agentForgotPassword');
    }

    public function resetpassword()
    {
        return view('auth.agent-resetpassword');
    }


    public function forgotpasswordSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:agents',
        ], [
            'email.required' => 'The email address is mandatory.',
            'email.string' => 'The email address must be a valid string.',
            'email.email' => 'The email address must be a valid email format.',
            'email.max' => 'The email address cannot exceed 255 characters.',
            'email.exists' => 'The provided email address is not registered in our system.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $token = Str::random(64);
        PasswordModel::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = PasswordModel::where('email', $request->email)->first();
        $sendMail = new AgentEmailForgetPassword($user->email, $user->token);

        try {
            Mail::to($user->email)->send($sendMail);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'An unexpected error occurred. Please try again later.']);
        }
        return back()->with('success', 'Password reset email has been sent. Please check your email.');
    }

    public function showResetPasswordForm($token)
    {
        $passwordReset = PasswordModel::where('token', $token)->first();
        if (!$passwordReset) {
            return response()->view('errors404'); // Or any other error view
        }

        return view('auth.agent.agentResetPassword', ['token' => $token]);
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $passwordReset = PasswordModel::where('token', $request->token)->first();

        if (!$passwordReset) {
            return redirect()->back()->withErrors(['token' => 'Invalid token.'])->withInput();
        }

        $agent = Agent::where('email', $passwordReset->email)->first();

        if (!$agent) {
            return redirect()->back()->withErrors(['email' => 'User not found.'])->withInput();
        }

        $agent->password = Hash::make($request->password);
        $agent->save();

        return redirect()->back()->with('success', 'Password updated successfully. You can now login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('agent.login');
    }
}
