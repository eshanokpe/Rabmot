<?php

namespace Tests\Feature\Admin;

use App\Models\AgentCommissionAuditLog;
use App\Models\AgentCommissionSetting;
use App\Models\AgentCommissionTier;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommissionManagementTest extends TestCase
{
    use DatabaseTransactions;

    public function test_super_admin_can_update_base_commission_rate(): void
    {
        $setting = AgentCommissionSetting::create(['rate' => 5]);
        $this->actingAsAdmin(['role' => 'super_admin']);

        $response = $this->put(route('admin.commission.updateBaseRate'), ['rate' => 12.5]);

        $response->assertRedirect(route('admin.commission.index'));
        $this->assertEquals(12.5, $setting->fresh()->rate);
        $this->assertDatabaseHas('agent_commission_audit_logs', ['action' => 'base_rate_updated']);
    }

    public function test_support_admin_is_denied_base_rate_update(): void
    {
        AgentCommissionSetting::create(['rate' => 5]);
        $this->actingAsAdmin(['role' => 'support_admin']);

        $response = $this->put(route('admin.commission.updateBaseRate'), ['rate' => 20]);

        $response->assertForbidden();
    }

    public function test_super_admin_can_create_update_and_delete_a_tier(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);

        $this->post(route('admin.commission.tiers.store'), [
            'name' => 'Bronze',
            'min_referrals' => 0,
            'max_referrals' => 9,
            'rate' => 3,
        ])->assertRedirect(route('admin.commission.index'));

        $tier = AgentCommissionTier::where('name', 'Bronze')->firstOrFail();

        $this->put(route('admin.commission.tiers.update', $tier->id), [
            'name' => 'Bronze',
            'min_referrals' => 0,
            'max_referrals' => 9,
            'rate' => 4,
        ])->assertRedirect(route('admin.commission.index'));

        $this->assertEquals(4, $tier->fresh()->rate);

        $this->delete(route('admin.commission.tiers.destroy', $tier->id))
            ->assertRedirect(route('admin.commission.index'));

        $this->assertDatabaseMissing('agent_commission_tiers', ['id' => $tier->id]);
    }
}
