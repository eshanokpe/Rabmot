<?php

namespace App\Console\Commands;

use App\Models\Broadcast;
use App\Services\BroadcastDispatchService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DispatchScheduledBroadcasts extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'broadcasts:dispatch-scheduled';

    /**
     * The console command description.
     */
    protected $description = 'Send broadcasts whose scheduled_at time has arrived';

    public function handle(): int
    {
        $broadcasts = Broadcast::where('delivery_status', 'scheduled')
            ->where('scheduled_at', '<=', now())
            ->get();

        if ($broadcasts->isEmpty()) {
            $this->info('No scheduled broadcasts due.');
            return self::SUCCESS;
        }

        $service = new BroadcastDispatchService();

        foreach ($broadcasts as $broadcast) {
            try {
                $service->send($broadcast);
                $this->info("[OK] Broadcast #{$broadcast->id} ({$broadcast->title}) dispatched.");
            } catch (\Throwable $e) {
                $this->error("[ERROR] Broadcast #{$broadcast->id} failed: {$e->getMessage()}");
                Log::error('Scheduled broadcast dispatch failed', [
                    'broadcast_id' => $broadcast->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return self::SUCCESS;
    }
}
