<?php

namespace Tests;

use App\Models\Admin;
use App\Models\Agent;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function actingAsAdmin(array $attributes = []): Admin
    {
        $admin = Admin::factory()->create(array_merge([
            'status' => 'active',
            'role' => 'super_admin',
        ], $attributes));

        $this->actingAs($admin, 'admin');

        return $admin;
    }

    protected function actingAsAgent(array $attributes = []): Agent
    {
        $agent = Agent::factory()->create(array_merge([
            'approval_status' => 'approved',
            'status' => 'active',
        ], $attributes));

        $this->actingAs($agent, 'agent');

        return $agent;
    }
}
