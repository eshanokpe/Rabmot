<?php

namespace Tests\Feature\Admin;

use App\Models\ProcessHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderDetailsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_view_an_order_detail_page(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);
        $user = User::factory()->create();
        $order = ProcessHistory::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->get(route('admin.orders.show', $order->id))
            ->assertOk()
            ->assertViewIs('admin.pages.orders.show')
            ->assertSee($order->process_number)
            ->assertSee('Status History');
    }
}
