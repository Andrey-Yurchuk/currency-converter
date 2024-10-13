<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * This class is responsible for defining the application's command schedule
 */
class Kernel extends ConsoleKernel
{
    /**
     * The commands provided by the application
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Schedules the daily execution of the currency:update-rates command
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('currency:update-rates')->daily();
    }

    /**
     * Register the commands for the application
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
