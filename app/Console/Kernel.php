<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // \App\Console\Commands\Inspire::class,
        \StreamJostle\Console\Commands\GameSummaryCron::class,
        \StreamJostle\Console\Commands\StreamSummaryCron::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('twitch:stream-summary')->everyFiveMinutes();
        $schedule->command('twitch:game-summary')->everyFiveMinutes();
    }
}
