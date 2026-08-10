<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use  App\Console\Commands\SendVehicleExpiryNotifications;
use App\Console\Commands\DispatchScheduledBroadcasts;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
   
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(SendVehicleExpiryNotifications::class)
            ->dailyAt('08:00')
            ->withoutOverlapping(10)
            ->appendOutputTo(storage_path('logs/vehicle-expiry-notifications.log'))
            ->emailOutputOnFailure(config('mail.from.address'));

        $schedule->command(DispatchScheduledBroadcasts::class)
            ->everyMinute()
            ->withoutOverlapping(5)
            ->appendOutputTo(storage_path('logs/broadcast-dispatch.log'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        // \App\Console\Commands\SendVehicleExpiryNotifications::class,
        require base_path('routes/console.php');
    }
}
