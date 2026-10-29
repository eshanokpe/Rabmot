<?php

namespace Tests\Feature\Auth;

use App\Mail\EmailVerificationCode;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailVerificationCodeTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_valid_code_verifies_the_pending_user_without_sending_a_link(): void
    {
        Mail::fake();
        $code = '123456';
        $user = User::factory()->create([
            'verified' => 0,
            'email_verification_code' => Hash::make($code),
            'email_verification_code_expires_at' => now()->addMinutes(10),
        ]);
        $this->withSession(['pending_email_verification_user_id' => $user->id]);

        $this->post(route('verification.code.submit'), ['code' => $code])
            ->assertOk()
            ->assertViewIs('frontend.emails.emailconfirm');

        $this->assertSame(1, (int) $user->fresh()->verified);
        $this->assertNull($user->fresh()->email_verification_code);
        $this->assertNull(session('pending_email_verification_user_id'));
        Mail::assertNothingSent();
    }

    public function test_an_incorrect_code_does_not_verify_the_user(): void
    {
        $user = User::factory()->create([
            'verified' => 0,
            'email_verification_code' => Hash::make('123456'),
            'email_verification_code_expires_at' => now()->addMinutes(10),
        ]);
        $this->withSession(['pending_email_verification_user_id' => $user->id]);

        $this->post(route('verification.code.submit'), ['code' => '654321'])
            ->assertRedirect(route('verification.code'))
            ->assertSessionHasErrors('code');

        $this->assertSame(0, (int) $user->fresh()->verified);
    }

    public function test_an_expired_code_cannot_verify_the_user(): void
    {
        $user = User::factory()->create([
            'verified' => 0,
            'email_verification_code' => Hash::make('123456'),
            'email_verification_code_expires_at' => now()->subMinute(),
        ]);
        $this->withSession(['pending_email_verification_user_id' => $user->id]);

        $this->post(route('verification.code.submit'), ['code' => '123456'])
            ->assertRedirect(route('verification.code'))
            ->assertSessionHas('error');

        $this->assertSame(0, (int) $user->fresh()->verified);
    }

    public function test_a_pending_user_can_request_a_new_verification_code(): void
    {
        Mail::fake();
        $user = User::factory()->create(['verified' => 0]);
        $this->withSession(['pending_email_verification_user_id' => $user->id]);

        $this->post(route('verification.code.resend'))
            ->assertRedirect(route('verification.code'))
            ->assertSessionHas('success');

        $user->refresh();
        $this->assertNotNull($user->email_verification_code);
        $this->assertTrue($user->email_verification_code_expires_at->isFuture());
        Mail::assertSent(EmailVerificationCode::class, function (EmailVerificationCode $mail) use ($user): bool {
            return $mail->user->is($user)
                && Hash::check($mail->code, $user->email_verification_code);
        });
    }
}
