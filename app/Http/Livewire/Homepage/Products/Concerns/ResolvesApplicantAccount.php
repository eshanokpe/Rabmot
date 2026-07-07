<?php

namespace App\Http\Livewire\Homepage\Products\Concerns;

use App\Mail\EmailVerification;
use App\Mail\WelcomeWithCredentialsMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait ResolvesApplicantAccount
{
    // Drives the inline "log in to continue" prompt shown on the payment step.
    public $accountExists  = false;
    public $loginPassword  = '';
    public $loginError     = '';

    /**
     * Resolve the user_id to attach to this application/order.
     *
     * - Logged in user: use their id.
     * - Guest with a brand-new email: create an account, email them the credentials, use the new id.
     * - Guest whose email already belongs to an account: refuse and flag the inline login
     *   prompt instead (prevents attaching an order to someone else's account just by typing
     *   their email; the form's fields/uploads stay intact since we never leave the page).
     *
     * @return int|null Resolved user id, or null if the caller should abort (prompt already flagged).
     */
    protected function resolveApplicantUserId(string $fullname, string $email, ?string $phone, string $processType, string $processId, $amount): ?int
    {
        if (Auth::check()) {
            return Auth::id();
        }

        $existing = User::where('email', $email)->first();

        if ($existing) {
            $this->accountExists = true;
            session()->flash('error', 'An account already exists with this email address. Please log in below to continue.');
            return null;
        }

        $tempPassword = Str::random(10);

        $user = User::create([
            'fullname'    => $fullname,
            'email'       => $email,
            'phone'       => $phone,
            'password'    => bcrypt($tempPassword),
            'email_token' => Str::random(60),
        ]);

        try {
            Mail::to($email)->send(new WelcomeWithCredentialsMail(
                $fullname,
                $email,
                $tempPassword,
                $processType,
                $processId,
                $amount
            ));
        } catch (\Exception $e) {
            \Log::warning('Welcome credentials email failed: ' . $e->getMessage());
        }

        try {
            Mail::to($email)->send(new EmailVerification($user));
        } catch (\Exception $e) {
            \Log::warning('Verification email failed: ' . $e->getMessage());
        }

        return $user->id;
    }

    /**
     * Log the applicant into their existing account without leaving the page, then
     * immediately resume the submission that was blocked (form fields and any uploaded
     * files are untouched since the component never re-mounted).
     */
    public function attemptLogin()
    {
        if (Auth::attempt(['email' => $this->email, 'password' => $this->loginPassword])) {
            $this->accountExists = false;
            $this->loginError    = '';
            $this->loginPassword = '';
            session()->forget('error');

            $this->processPayment();
            return;
        }

        $this->loginError = 'Incorrect password. Please try again.';
    }

    public function updatedEmail()
    {
        $this->accountExists = false;
        $this->loginError    = '';
    }
}
