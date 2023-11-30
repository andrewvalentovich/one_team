<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:get-rates')->daily();
        $schedule->command('products:update-base-price')->daily();
        $schedule->command('layouts:update-base-price')->daily();
        $schedule->command('sitemap:generate')->daily();
        //$schedule->command('crm:import-complex 8')->everyTenMinutes();
        Log::info(date('m/d/Y h:i:s a', time()) . " Schedule called");
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
