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
         Commands\NewsletterCron::class,
         Commands\VideoConverterCron::class,
         Commands\SchedulePostCron::class,
         Commands\QueueWorkCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {                 
        // $schedule->command('optimize:clear')
        //         ->emailOutputTo('ex4useonly@gmail.com');
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('newsletter:cron')->withoutOverlapping()->everyMinute();
        $schedule->command('videoConverter:cron')->withoutOverlapping()->everyFiveMinutes();
        $schedule->command('schedulepost:cron')->withoutOverlapping()->everyFiveMinutes();
        $schedule->command('queue:cron')->withoutOverlapping()->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
