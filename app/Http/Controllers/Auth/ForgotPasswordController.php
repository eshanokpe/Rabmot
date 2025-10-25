<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PasswordModel; // or DB facade if you're using that
use App\Mail\EmailForgetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password; 

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */ 

    use SendsPasswordResetEmails;

    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    public function showResetForm()
    { 
        return view('auth.passwords.reset');
    } 

   
    
    public function submitForgetPasswordForm(Request $request)
    {
        // Validate first - let Laravel handle the validation exception
        $validated = $request->validate([
            'email' => 'required|email|exists:users',
        ]);
    
        // Generate token
        $token = Str::random(64);
        
        // Delete any existing tokens for this email
        PasswordModel::where('email', $request->email)->delete();
        
        // Create new token
        PasswordModel::create([
            'email' => $request->email, 
            'token' => Hash::make($token), // Always hash tokens before storage
            'created_at' => Carbon::now()
        ]);
    
        try {
            // Send email - pass the plain token for the link
            Mail::to($request->email)->send(new EmailForgetPassword([
                'email' => $request->email,
                'token' => $token // Unhashed token for the reset link
            ]));
            
            return back()->with('status', 'We have emailed your password reset link!');
            
        } catch (\Exception $e) {
            logger()->error('Password reset email failed: '.$e->getMessage());
            return back()->withInput()->withErrors([
                'email' => 'Failed to send reset link. Please try again later.'
            ]);
        }
    }
 
    public function showResetPasswordForm($token) { 
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required'
        ]);

        // Verify token exists for this email
        $passwordReset = DB::table('password_resets')
                          ->where('email', $request->email)
                          ->first();

        if (!$passwordReset) {
            return back()->withInput()->with('error', 'Invalid password reset request');
        }

        // Verify token matches
        if (!Hash::check($request->token, $passwordReset->token)) {
            return back()->withInput()->with('error', 'Invalid token');
        }

        // Update user's password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Delete the password reset token
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Redirect with success message
        return redirect()->route('processpapers')->with('success', 'Your password has been changed successfully!');
    }

    public function submitResetPasswordFormcc(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed', // Increased minimum to 8 for better security
            'password_confirmation' => 'required',
            'token' => 'required' // Make sure token is required
        ]);
    
        // Check if the token exists and is valid
        $updatePassword = DB::table('password_resets')
                            ->where('email', $request->email)
                            ->first();
    
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid email for password reset!');
        }
    
        // Verify the token matches
        if (!Hash::check($request->token, $updatePassword->token)) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
    
        // Update the user's password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
    
        // Delete all password reset tokens for this email
        DB::table('password_resets')->where('email', $request->email)->delete();
    
        // Optionally, log the user in automatically after password reset
        // auth()->attempt(['email' => $request->email, 'password' => $request->password]);
    
        return redirect()->route('processpapers')->with('success', 'Your password has been changed successfully!');
    }
}
