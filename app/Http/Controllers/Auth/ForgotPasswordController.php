<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
 
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
        return view('auth.passwords.');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|exists:users',
            ]);
        } catch (ValidationException $exception) {
            // Redirect back to the form with validation errors
            return back()->withErrors($exception->validator->errors())->withInput();
        } 
        
        $token = Str::random(64);
        
        PasswordModel::create([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
        $user = PasswordModel::where('email',$request->email)->first();
        $email = new EmailForgetPassword($user);
        
        
        try {
            Mail::to($user->email)->send($email);
        } catch (\Exception $e) {
            // Handle email sending error here
            // For example, log the error or return a response to the user
            return back()->withErrors(['email' => 'Failed to send reset password email. Please try again later.']);
        }

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token) { 
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $updatePassword = DB::table('password_resets')
                            ->where([
                                'email' => $request->email,
                                'token' => $request->token
                            ])->first();
        if(!$updatePassword){
            return back()->with('error', 'Invalida token!');
        }

        $users = User::where('email', $request->email)
                    ->update([
                        'password' =>  Hash::make($request->password),
                    ]);
        
        DB::table('password_resets')->where([
            'email' => $request->email
        ])->delete();
        return redirect()->route('processpapers')->with('success', 'Your password has been changed!');
        // return redirect('processpapers')->with('success'. 'Your password has been changed!');
    }
}
