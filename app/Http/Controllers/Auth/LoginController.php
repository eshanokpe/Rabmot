<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Http;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    public function __construct()
    { 
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the reCAPTCHA response
        $recaptcha = $request->input('g-recaptcha-response');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secretKey'),
            'response' => $recaptcha,
            'remoteip' => $request->ip(),
        ]);
        $recaptcha_success = $response->json('success');

        if (!$recaptcha_success) {
            return redirect()->back()->with('recaptcha_error', 'Please verify that you are not a robot.');
        }

        // Validate login credentials
        $this->validateLogin($request);

        // Attempt to log the user in
        $credentials = $this->credentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();

            // Check if the user's account is disabled
            if ($user->status_id == 0) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been disabled. Contact the admin for further details.',
                ]);
            }

            // Check if the user's email is verified
            if ($user->verified == 0) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Please verify your account before logging in.',
                ]);
            }

            // Redirect to intended page or default home route
            return redirect()->intended('/home');
        }

        // If the login attempt was unsuccessful, redirect back to the login form
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    /**
     * Get the login credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to the login page or the home page
        return redirect()->route('processpapers');
    }

    public function showLoginForm()
    {
        return redirect()->route('processpapers');
    }
}
