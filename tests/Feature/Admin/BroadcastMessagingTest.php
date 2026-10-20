<?php

namespace Tests\Feature\Admin;

use App\Mail\BroadcastMail;
use App\Models\Broadcast;
use App\Models\BroadcastDelivery;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request as HttpRequest;
use Illuminate\Support\Facades\Http;
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
            'channels' => ['in_app', 'email'],
        ]);

        $response->assertRedirect(route('admin.broadcasts.history'));

        $broadcast = Broadcast::firstOrFail();
        $this->assertEquals('sent', $broadcast->delivery_status);

        $deliveries = BroadcastDelivery::where('broadcast_id', $broadcast->id)->get();
        $this->assertCount(2, $deliveries);
        $this->assertEquals('sent', $deliveries->firstWhere('channel', 'in_app')->status);
        $this->assertEquals('sent', $deliveries->firstWhere('channel', 'email')->status);

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

    public function test_sms_broadcast_is_sent_through_termii_and_records_recipient_phone(): void
    {
        Http::fake([
            'https://api.ng.termii.com/api/sms/send' => Http::response([
                'code' => 'ok',
                'message_id' => 'termii-message-id',
            ], 200),
        ]);
        $this->actingAsAdmin(['role' => 'super_admin']);
        $user = User::factory()->create([
            'phone' => '08012345678',
        ]);

        $settings = Setting::query()->first() ?? new Setting();
        $settings->sms_provider = 'Termii';
        $settings->sms_api_key = 'test-api-key';
        $settings->sms_sender_id = 'RABMOT';
        $settings->save();
        Setting::forgetCache();

        $response = $this->post(route('admin.broadcasts.store'), [
            'title' => 'Service Update',
            'body' => '<p>Hello &amp; welcome</p><p>Again.</p>',
            'target_audience' => 'specific_user',
            'target_ids' => [$user->id],
            'channels' => ['sms'],
        ]);

        $response->assertRedirect(route('admin.broadcasts.history'));

        $delivery = BroadcastDelivery::where('channel', 'sms')->firstOrFail();
        $this->assertEquals('sent', $delivery->status);
        $this->assertEquals('08012345678', $delivery->recipient_phone);
        Http::assertSent(function (HttpRequest $request) {
            return $request->url() === 'https://api.ng.termii.com/api/sms/send'
                && $request['to'] === '2348012345678'
                && $request['from'] === 'RABMOT'
                && $request['sms'] === 'Hello & welcome Again.'
                && $request['type'] === 'plain'
                && $request['channel'] === 'generic';
        });
    }

    public function test_sms_delivery_fails_and_is_logged_when_recipient_has_no_phone(): void
    {
        Http::fake();
        $this->actingAsAdmin(['role' => 'super_admin']);
        $user = User::factory()->create(['phone' => null]);

        $this->post(route('admin.broadcasts.store'), [
            'title' => 'Service Update',
            'body' => '<p>Hello</p>',
            'target_audience' => 'specific_user',
            'target_ids' => [$user->id],
            'channels' => ['sms'],
        ])->assertRedirect(route('admin.broadcasts.history'));

        $delivery = BroadcastDelivery::where('channel', 'sms')->firstOrFail();
        $this->assertEquals('failed', $delivery->status);
        $this->assertEquals('Recipient has no valid phone number.', $delivery->error_message);
        Http::assertNothingSent();
    }

    public function test_whatsapp_broadcast_is_sent_through_termii_and_records_recipient_phone(): void
    {
        Http::fake([
            'https://termii.test/api/sms/send' => Http::response([
                'message_id' => 'termii-whatsapp-message-id',
            ], 200),
        ]);
        config([
            'services.termii.base_url' => 'https://termii.test',
            'services.termii.api_key' => 'env-api-key',
            'services.termii.whatsapp_sender_id' => 'env-device',
        ]);
        $this->actingAsAdmin(['role' => 'super_admin']);
        $user = User::factory()->create([
            'phone' => '+2348012345678',
        ]);

        $settings = Setting::query()->first() ?? new Setting();
        $settings->sms_provider = null;
        $settings->sms_api_key = null;
        $settings->whatsapp_sender_id = null;
        $settings->save();
        Setting::forgetCache();

        $response = $this->post(route('admin.broadcasts.store'), [
            'title' => 'Service Update',
            'body' => '<p>Hello &amp; welcome</p>',
            'target_audience' => 'specific_user',
            'target_ids' => [$user->id],
            'channels' => ['whatsapp'],
        ]);

        $response->assertRedirect(route('admin.broadcasts.history'));

        $delivery = BroadcastDelivery::where('channel', 'whatsapp')->firstOrFail();
        $this->assertEquals('sent', $delivery->status);
        $this->assertEquals('+2348012345678', $delivery->recipient_phone);
        Http::assertSent(function (HttpRequest $request) {
            return $request->url() === 'https://termii.test/api/sms/send'
                && $request['api_key'] === 'env-api-key'
                && $request['to'] === '2348012345678'
                && $request['from'] === 'env-device'
                && $request['sms'] === 'Hello & welcome'
                && $request['type'] === 'plain'
                && $request['channel'] === 'whatsapp';
        });
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
