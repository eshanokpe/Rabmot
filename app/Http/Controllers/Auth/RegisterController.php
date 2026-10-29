<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Http;
use App\Mail\EmailVerificationCode;
use App\Mail\EmailConfirmation;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\ReferralLog;
use Illuminate\Support\Str;



class RegisterController extends Controller
{
    
    use RegistersUsers;

    
   // protected $redirectTo = ::HOME;
    protected $redirectTo = '/processpaper';
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:30'],
            'phone' => ['required', 'min:11', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response'=> 'required',
        ]);
    } 

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    
   
     public function register(Request $request)
     {
         // Validate input
         $validator = Validator::make($request->all(), [
             'fullname' => 'required|string|max:40',
             'email' => 'required|string|email|max:40|unique:users',
             'phone' => 'required|string|max:18',
             'password' => 'required|string|min:8|confirmed',
             'know_us' => 'required|string',
             'agreed' => 'required',
             'g-recaptcha-response' => 'required',
         ]);
     
         // Handle validation errors
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
     
         // Verify Google reCAPTCHA
         $recaptcha = $request->input('g-recaptcha-response');
         $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
             'secret' => config('services.recaptcha.secretKey'),
             'response' => $recaptcha,
             'remoteip' => $request->ip(),
         ]);
     
         if (!$response['success']) {
             return redirect()->back()->with(['recaptcha_error' => 'Please verify that you are not a robot.']);
         }
     
         $referringUser = null;
         $referralCode = $this->generateReferralCode(); 
     
         if ($request->filled('referral_code')) {
             $referringUser = User::where('referral_code', $request->input('referral_code'))->first();
     
             // Handle invalid referral code
             if (!$referringUser) {
                 return redirect()->back()->with('error', 'The referral code provided is invalid.');
             }
     
             // Increment referrer count
             $referringUser->increment('referrer_count');
     
             // Calculate tokens for the referrer
             $tokensEarned = 10 * $referringUser->referrer_count;
         }
     
         $verificationCode = (string) random_int(100000, 999999);

         // Create the new user
         $user = User::create([
             'fullname' => $request->input('fullname'),
             'email' => $request->input('email'),
             'phone' => $request->input('phone'),
             'role' => 3,
             'password' => bcrypt($request->input('password')),
             'status_id' => 1,
             'status' => 'active',
             'referral_code' => $referralCode,
             'verified' => 0,
         ]);
         $user->email_verification_code = Hash::make($verificationCode);
         $user->email_verification_code_expires_at = now()->addMinutes(10);
         $user->save();
     
         // Create referral and token records if applicable
         if ($referringUser) {
             $referringUser->tokens()->create([
                 'user_id' => $referringUser->id,
                 'referral_user_id' => $user->id,
                 'token_count' => $tokensEarned,
             ]);
     
             ReferralLog::create([
                 'referrer_id' => $referringUser->id,
                 'referred_id' => $user->id,
                 'referral_code' => $request->input('referral_code'),
                 'referred_at' => now(),
             ]);
         }
     
         // Create a token record for the new user with 0 tokens
         $user->tokens()->create([
             'user_id' => $user->id,
             'referral_user_id' => $referringUser ? $referringUser->id : null,
             'token_count' => 0,
         ]); 
         $wallet = Wallet::create([ 
            'user_id' => $user->id,
            'user_email' => $user->email,
            'userType' => 'user',
            'amount' => 0.00,
            'status' => 0
        ]);
     
         $request->session()->put('pending_email_verification_user_id', $user->id);

         try {
             Mail::to($user->email)->send(new EmailVerificationCode($user, $verificationCode));
         } catch (\Throwable $e) {
             Log::error('Registration email verification code could not be sent.', [
                 'user_id' => $user->id,
                 'exception' => $e->getMessage(),
             ]);

             return redirect()->route('verification.code')
                 ->with('error', 'Your account was created, but the verification code could not be emailed. Please try sending a new code.');
         }
     
         return redirect()->route('verification.code')
             ->with('success', 'Your account was created. Enter the verification code sent to your email address.');
     }

    public function showVerificationCode(Request $request)
    {
        $user = User::find($request->session()->get('pending_email_verification_user_id'));

        if (!$user) {
            return redirect()->route('signup')->with('error', 'Please create an account before verifying your email.');
        }

        if ($user->verified) {
            return redirect()->route('processpapers')->with('success', 'Your email address is already verified.');
        }

        return view('frontend.emails.verification-code', compact('user'));
    }

    public function verifyCode(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|digits:6',
        ]);
        $user = User::find($request->session()->get('pending_email_verification_user_id'));

        if (!$user) {
            return redirect()->route('signup')->with('error', 'Your verification session has expired. Please sign up again.');
        }

        if ($user->verified) {
            return redirect()->route('processpapers')->with('success', 'Your email address is already verified.');
        }

        if (!$user->email_verification_code || !$user->email_verification_code_expires_at || $user->email_verification_code_expires_at->isPast()) {
            return redirect()->route('verification.code')->with('error', 'Your verification code has expired. Request a new code to continue.');
        }

        if (!Hash::check($validated['code'], $user->email_verification_code)) {
            return redirect()->route('verification.code')->withErrors([
                'code' => 'That verification code is incorrect. Please check your email and try again.',
            ]);
        }

        $user->verified = 1;
        $user->email_verification_code = null;
        $user->email_verification_code_expires_at = null;
        $user->save();
        $request->session()->forget('pending_email_verification_user_id');

        Notifications::create([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'fullname' => $user->fullname,
            'userType' => 'user',
            'title' => 'User account creation',
            'message' => 'A new user account has been created.',
        ]);

        return view('frontend.emails.emailconfirm', compact('user'));
    }

    public function resendVerificationCode(Request $request)
    {
        $user = User::find($request->session()->get('pending_email_verification_user_id'));

        if (!$user) {
            return redirect()->route('signup')->with('error', 'Your verification session has expired. Please sign up again.');
        }

        if ($user->verified) {
            return redirect()->route('processpapers')->with('success', 'Your email address is already verified.');
        }

        $verificationCode = (string) random_int(100000, 999999);
        $user->email_verification_code = Hash::make($verificationCode);
        $user->email_verification_code_expires_at = now()->addMinutes(10);
        $user->save();

        try {
            Mail::to($user->email)->send(new EmailVerificationCode($user, $verificationCode));
        } catch (\Throwable $e) {
            Log::error('Registration email verification code could not be resent.', [
                'user_id' => $user->id,
                'exception' => $e->getMessage(),
            ]);

            return redirect()->route('verification.code')
                ->with('error', 'We could not send a new verification code. Please try again later.');
        }

        return redirect()->route('verification.code')->with('success', 'A new verification code has been sent.');
    }
     

    private function generateReferralCode(): string
    {
        do {
            $code = 'Rabmot' . strtoupper(Str::random(6));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }

    public function verify($token)
    {
        if ( ! $token)
        {
            return  redirect('processpapers')->with('flash-error','Email Verification Token not provided!');
        }
        
        $user = User::where('email_token',$token)->first();
        if ( ! $user)
        {
            return  redirect('processpapers')->with('flash-error','Invalid Email Verification Token!');
        }

        $user->verified = 1;

        if ($user->save()) {
            $id = $user->id;
            $email = $user->email;
            $fullname = $user->fullname;

            $notification = [
                'user_id' => $id,
                'user_email' => $email,
                'fullname' => $fullname,
                'userType' => 'user',
                'title'=>'User account creation',
                'message' => 'A new user account has been created.',
                // Add any other relevant data for the notification
            ];
    
            // Save the notification record in the Notification table
            Notifications::create($notification);
 
            $email = new EmailConfirmation($user);
            Mail::to($user->email)->send($email);
           
            return view('frontend.emails.emailconfirm',['user'=>$user]);

        }
    }
}
