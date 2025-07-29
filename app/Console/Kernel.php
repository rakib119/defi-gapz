<?php

namespace App\Console;

use App\Http\Controllers\ScheduleController;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
        $controller = new ScheduleController();
        $schedule->call([$controller,'compititionSchedular'])->everyFiveMinutes();
        $schedule->call([$controller,'investmentSchedular'] )->everyFiveMinutes();
        // $schedule->call([$controller,'create_user'] )->everyFiveMinutes();
        $schedule->call([$controller,'teamIncomeScheduler'])->dailyAt('23:55');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
