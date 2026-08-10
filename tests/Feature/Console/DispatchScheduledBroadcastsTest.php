<?php

namespace Tests\Feature\Console;

use App\Models\Broadcast;
use App\Models\BroadcastDelivery;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class DispatchScheduledBroadcastsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_due_scheduled_broadcast_is_sent(): void
    {
        Mail::fake();
        $user = User::factory()->create();
        $broadcast = Broadcast::factory()->create([
            'target_audience' => 'specific_user',
            'target_ids' => [$user->id],
            'channels' => ['in_app'],
            'delivery_status' => 'scheduled',
            'scheduled_at' => now()->subMinute(),
        ]);

        Artisan::call('broadcasts:dispatch-scheduled');

        $broadcast->refresh();
        $this->assertEquals('sent', $broadcast->delivery_status);
        $this->assertEquals(1, BroadcastDelivery::where('broadcast_id', $broadcast->id)->count());
    }

    public function test_a_future_scheduled_broadcast_is_left_untouched(): void
    {
        $broadcast = Broadcast::factory()->create([
            'delivery_status' => 'scheduled',
            'scheduled_at' => now()->addHour(),
        ]);

        Artisan::call('broadcasts:dispatch-scheduled');

        $this->assertEquals('scheduled', $broadcast->fresh()->delivery_status);
        $this->assertEquals(0, BroadcastDelivery::where('broadcast_id', $broadcast->id)->count());
    }
}
