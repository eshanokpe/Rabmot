<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class RbacGateTest extends TestCase
{
    private const ROLES = ['super_admin', 'finance_admin', 'operations_admin', 'support_admin'];

    /**
     * Exhaustively asserts the manage-{area}/view-{area} Gate closures registered in
     * AuthServiceProvider match config/admin_permissions.php exactly, for every area x role.
     * This is the permanent replacement for the manual gate-suite checks run by hand all session.
     */
    public function test_gate_matrix_matches_admin_permissions_config(): void
    {
        $areas = config('admin_permissions.areas');

        foreach ($areas as $area => $roles) {
            foreach (self::ROLES as $role) {
                $admin = new Admin(['role' => $role]);

                $expectedManage = in_array($role, $roles['manage']);
                $expectedView = $expectedManage || in_array($role, $roles['view']);

                $this->assertSame(
                    $expectedManage,
                    Gate::forUser($admin)->allows("manage-{$area}"),
                    "manage-{$area} mismatch for role {$role}"
                );

                $this->assertSame(
                    $expectedView,
                    Gate::forUser($admin)->allows("view-{$area}"),
                    "view-{$area} mismatch for role {$role}"
                );
            }
        }
    }
}
