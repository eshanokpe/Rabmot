<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use  App\Console\Commands\SendVehicleExpiryNotifications;

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
            // ->dailyAt('08:00')
            ->everyMinute()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/vehicle-expiry-notifications.log'))
            ->emailOutputOnFailure(config('mail.from.address'));
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
