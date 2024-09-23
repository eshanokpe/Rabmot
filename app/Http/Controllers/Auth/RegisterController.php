<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Events\UserCreating;
use Mail;
use Http; 
use App\Mail\MailNotify;
use App\Mail\EmailVerification;
use App\Mail\EmailConfirmation;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\Notifications;


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
       
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:40',
            'email' => 'required|string|email|max:40|unique:users',
            'phone' => 'required|string|max:18',
            'password' => 'required|string|min:8|confirmed',
            'know_us' => 'required|string',
            'agreed' => 'required',
            'g-recaptcha-response'=> 'required',
        ]);
        
        $recaptcha = $request->input('g-recaptcha-response');
        
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secretKey'),
            'response' => $recaptcha,
            'remoteip' => \request()->ip()
        ]);
     
     
        $recaptcha_success = $response['success'];

        if (!$recaptcha_success) {
            return redirect()->back()->with(['recaptcha_error' => 'Please verify that you are not a robot.']);
        }
      
        // Checking if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
       
        $referringUser = null;
        if ($request->filled('referral_code')) {
            $referringUser = User::where('referral_code', $request->input('referral_code'))->first(); 
            if (!$referringUser) {
                // Redirect back with error if referral code is invalid
                return redirect()->back()->with('error', 'The referral code provided is invalid.');
            }
            if ($referringUser) {
                $referringUser->referrer_count++;
                $referringUser->save();
                // Check if referring user has reached 10 referrals
                 $referralCount = $referringUser->referrer_count;
                $tokensEarned = 10 * $referralCount;
                
                $referringUser->tokens()->create([
                    'user_id' => $referringUser->id,
                    'referral_user_id' => $referringUser->id,
                    'token_count' => $tokensEarned,
                    'g-recaptcha-response'=> 'required',
                ]);
                
            }
        }else{
            
            $user = User::create([
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'email_token' => bin2hex(openssl_random_pseudo_bytes(30)),
                'phone' => $request->input('phone'),
                'role' => 3,
                'password' => bcrypt($request->input('password')),
                'status_id' => 1,
                'referral_code' => $request->filled('referral_code') ? $request->input('referral_code') : null,
            ]);
            
            $tokensEarnedByNewUser = 0; 
            $user->tokens()->create([
                'user_id' => $user->id,
                'referral_user_id' => $referringUser ? $referringUser->id : null,
                'token_count' => $tokensEarnedByNewUser,
            ]);
           
            event(new Registered($user));
           
            try {
                Mail::to($user->email)->send(new EmailVerification($user));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Email verification failed');
            }
        }
        // Redirecting to the email verification view
        return view('frontend.emails.verification');
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
