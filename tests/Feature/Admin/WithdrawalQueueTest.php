<?php

namespace Tests\Feature\Admin;

use App\Models\Wallet;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WithdrawalQueueTest extends TestCase
{
    use DatabaseTransactions;

    public function test_finance_admin_can_approve_a_pending_withdrawal(): void
    {
        $wallet = Wallet::factory()->create(['status' => 'pending']);
        $this->actingAsAdmin(['role' => 'finance_admin']);

        $response = $this->put(
            route('admin.withdrawalQueue.approve', encrypt($wallet->id)),
            ['confirm_approval' => 1]
        );

        $response->assertRedirect();
        $this->assertEquals('approved', $wallet->fresh()->status);
    }

    public function test_finance_admin_can_reject_a_pending_withdrawal(): void
    {
        $wallet = Wallet::factory()->create(['status' => 'pending']);
        $this->actingAsAdmin(['role' => 'finance_admin']);

        $response = $this->put(
            route('admin.withdrawalQueue.reject', encrypt($wallet->id)),
            ['rejection_reason' => 'Insufficient documentation provided.']
        );

        $response->assertRedirect();
        $wallet->refresh();
        $this->assertEquals('rejected', $wallet->status);
        $this->assertEquals('Insufficient documentation provided.', $wallet->rejection_reason);
    }

    public function test_support_admin_is_denied_approving_a_withdrawal(): void
    {
        $wallet = Wallet::factory()->create(['status' => 'pending']);
        $this->actingAsAdmin(['role' => 'support_admin']);

        $response = $this->put(
            route('admin.withdrawalQueue.approve', encrypt($wallet->id)),
            ['confirm_approval' => 1]
        );

        $response->assertForbidden();
    }
}
