<?php

namespace Tests\Feature\Admin;

use App\Mail\BroadcastMail;
use App\Models\Broadcast;
use App\Models\BroadcastDelivery;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BroadcastMessagingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_immediate_broadcast_sends_in_app_and_email_and_records_deliveries(): void
    {
        Mail::fake();
        $this->actingAsAdmin(['role' => 'super_admin']);
        $user = User::factory()->create();

        $response = $this->post(route('admin.broadcasts.store'), [
            'title' => 'Scheduled Maintenance',
            'body' => '<p>We will be down briefly.</p>',
            'target_audience' => 'specific_user',
            'target_ids' => [$user->id],
            'channels' => ['in_app', 'email', 'whatsapp'],
        ]);

        $response->assertRedirect(route('admin.broadcasts.history'));

        $broadcast = Broadcast::firstOrFail();
        $this->assertEquals('sent', $broadcast->delivery_status);

        $deliveries = BroadcastDelivery::where('broadcast_id', $broadcast->id)->get();
        $this->assertCount(3, $deliveries);
        $this->assertEquals('sent', $deliveries->firstWhere('channel', 'in_app')->status);
        $this->assertEquals('sent', $deliveries->firstWhere('channel', 'email')->status);

        // Regression test: WhatsApp is recorded as skipped, not attempted — the
        // fixed version of the in_array()-on-a-boolean TypeError that used to
        // crash any immediate send with a WhatsApp channel checked.
        $this->assertEquals('skipped', $deliveries->firstWhere('channel', 'whatsapp')->status);

        $this->assertDatabaseHas('notifications', ['user_id' => $user->id, 'type' => 'broadcast']);
        Mail::assertSent(BroadcastMail::class, 1);
    }

    public function test_large_audience_is_auto_deferred_to_the_scheduler_instead_of_sent_inline(): void
    {
        Mail::fake();
        $this->actingAsAdmin(['role' => 'super_admin']);
        User::factory()->count(101)->create();

        $response = $this->post(route('admin.broadcasts.store'), [
            'title' => 'Big Announcement',
            'body' => '<p>Hello everyone.</p>',
            'target_audience' => 'all_users',
            'channels' => ['in_app'],
        ]);

        $response->assertRedirect(route('admin.broadcasts.history'));

        $broadcast = Broadcast::firstOrFail();
        $this->assertEquals('scheduled', $broadcast->delivery_status);
        $this->assertNotNull($broadcast->scheduled_at);
        $this->assertEquals(0, BroadcastDelivery::where('broadcast_id', $broadcast->id)->count());
        Mail::assertNothingSent();
    }

    public function test_preview_count_returns_correct_count_per_audience(): void
    {
        $this->actingAsAdmin(['role' => 'super_admin']);
        User::factory()->count(3)->create(['role' => 'consumer']);

        $response = $this->get(route('admin.broadcasts.previewCount', ['target_audience' => 'all_consumers']));

        $response->assertOk();
        $response->assertJson(['count' => 3]);
    }

    public function test_show_renders_the_delivery_log(): void
    {
        Mail::fake();
        $admin = $this->actingAsAdmin(['role' => 'super_admin']);
        $broadcast = Broadcast::factory()->create(['admin_id' => $admin->id, 'delivery_status' => 'sent']);
        BroadcastDelivery::create([
            'broadcast_id' => $broadcast->id,
            'recipient_type' => 'user',
            'recipient_id' => 1,
            'recipient_email' => 'test@example.com',
            'channel' => 'email',
            'status' => 'sent',
            'delivered_at' => now(),
        ]);

        $response = $this->get(route('admin.broadcasts.show', $broadcast->id));

        $response->assertOk();
        $response->assertSee('test@example.com');
    }
}
