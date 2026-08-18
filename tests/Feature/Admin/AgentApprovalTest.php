<?php

namespace Tests\Feature\Admin;

use App\Models\Agent;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AgentApprovalTest extends TestCase
{
    use DatabaseTransactions;

    public function test_operations_admin_can_approve_a_pending_agent(): void
    {
        $agent = Agent::factory()->create(['approval_status' => 'pending']);
        $this->actingAsAdmin(['role' => 'operations_admin']);

        $response = $this->put(route('admin.agentApprovals.approve', encrypt($agent->id)));

        $response->assertRedirect(route('admin.agentApprovals.index'));
        $agent->refresh();
        $this->assertEquals('approved', $agent->approval_status);
        $this->assertNotNull($agent->approved_at);
    }

    public function test_operations_admin_can_reject_a_pending_agent(): void
    {
        $agent = Agent::factory()->create(['approval_status' => 'pending']);
        $this->actingAsAdmin(['role' => 'operations_admin']);

        $response = $this->put(route('admin.agentApprovals.reject', encrypt($agent->id)), [
            'rejection_reason' => 'Submitted ID document is unreadable.',
        ]);

        $response->assertRedirect(route('admin.agentApprovals.index'));
        $agent->refresh();
        $this->assertEquals('rejected', $agent->approval_status);
        $this->assertEquals('Submitted ID document is unreadable.', $agent->rejection_reason);
    }

    public function test_support_admin_is_denied_approving_an_agent(): void
    {
        $agent = Agent::factory()->create(['approval_status' => 'pending']);
        $this->actingAsAdmin(['role' => 'support_admin']);

        $response = $this->put(route('admin.agentApprovals.approve', encrypt($agent->id)));

        $response->assertForbidden();
    }

    public function test_a_pending_agent_cannot_authenticate_as_agent(): void
    {
        $agent = Agent::factory()->create(['approval_status' => 'pending', 'status' => 'active']);

        $response = $this->actingAs($agent, 'agent')->get(route('agent.dashboard'));

        $response->assertRedirect(route('agent.login'));
    }
}
