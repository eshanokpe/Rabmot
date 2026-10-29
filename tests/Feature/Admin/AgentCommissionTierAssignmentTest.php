<?php

namespace Tests\Feature\Admin;

use App\Models\Agent;
use App\Models\AgentCommissionTier;
use App\Services\AgentReferralCommissionService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AgentCommissionTierAssignmentTest extends TestCase
{
    use DatabaseTransactions;

    public function test_super_admin_can_assign_a_shared_tier_to_an_agent(): void
    {
        $admin = $this->actingAsAdmin(['role' => 'super_admin']);
        $agent = Agent::factory()->create();
        $tier = AgentCommissionTier::create([
            'name' => 'Preferred',
            'min_referrals' => 3,
            'max_referrals' => 8,
            'rate' => 7.5,
            'sort_order' => 1,
        ]);

        $this->put(route('admin.agent.setCommissionTier', encrypt($agent->id)), [
            'commission_tier_id' => $tier->id,
        ])->assertRedirect();

        $agent->refresh();
        $this->assertEquals($tier->id, $agent->commission_tier_id);
        $this->assertDatabaseHas('agent_commission_audit_logs', [
            'admin_id' => $admin->id,
            'subject_agent_id' => $agent->id,
            'subject_tier_id' => $tier->id,
            'action' => 'agent_tier_assigned',
        ]);

        $resolution = (new AgentReferralCommissionService())->resolveRateForAgent($agent);
        $this->assertSame('assigned_tier', $resolution['source']);
        $this->assertEquals(7.5, $resolution['rate']);
    }

    public function test_super_admin_can_clear_an_agent_tier_assignment(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);
        $tier = AgentCommissionTier::create([
            'name' => 'Preferred',
            'min_referrals' => 3,
            'max_referrals' => 8,
            'rate' => 7.5,
            'sort_order' => 1,
        ]);
        $agent = Agent::factory()->create(['commission_tier_id' => $tier->id]);

        $this->put(route('admin.agent.setCommissionTier', encrypt($agent->id)), [
            'commission_tier_id' => '',
        ])->assertRedirect();

        $this->assertNull($agent->fresh()->commission_tier_id);
    }

    public function test_super_admin_can_assign_a_shared_tier_when_creating_an_agent(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);
        Mail::fake();

        $tier = AgentCommissionTier::create([
            'name' => 'Preferred',
            'min_referrals' => 3,
            'max_referrals' => 8,
            'rate' => 7.5,
            'sort_order' => 1,
        ]);

        $this->post(route('admin.agent.store'), [
            'username' => 'tiered-agent',
            'email' => 'tiered-agent@example.test',
            'fullname' => 'Tiered Agent',
            'phone_no' => '555-0100',
            'password' => 'password123',
            'cpassword' => 'password123',
            'location' => 'Lagos',
            'gender' => 'female',
            'commission_tier_id' => $tier->id,
        ])->assertRedirect();

        $agent = Agent::where('email', 'tiered-agent@example.test')->firstOrFail();
        $this->assertEquals($tier->id, $agent->commission_tier_id);
        $this->assertDatabaseHas('agent_commission_audit_logs', [
            'subject_agent_id' => $agent->id,
            'subject_tier_id' => $tier->id,
            'action' => 'agent_tier_assigned',
        ]);
    }

    public function test_agent_is_created_and_failure_is_reported_when_welcome_email_cannot_be_sent(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);
        Mail::shouldReceive('to')
            ->once()
            ->with('mail-failure@example.test')
            ->andThrow(new \RuntimeException('SMTP unavailable'));
        Log::shouldReceive('warning')->once();

        $this->post(route('admin.agent.store'), [
            'username' => 'mail-failure-agent',
            'email' => 'mail-failure@example.test',
            'fullname' => 'Mail Failure Agent',
            'phone_no' => '555-0101',
            'password' => 'password123',
            'cpassword' => 'password123',
            'location' => 'Lagos',
            'gender' => 'male',
        ])
            ->assertRedirect(route('admin.agents'))
            ->assertSessionHas('warning');

        $this->assertDatabaseHas('agents', [
            'email' => 'mail-failure@example.test',
            'username' => 'mail-failure-agent',
        ]);
    }
}
