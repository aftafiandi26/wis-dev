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
        //
        'App\Console\Commands\cronBirthdayEmail',
        'App\Console\Commands\cronReminderSotfware',
        'App\Console\Commands\cronFinanceTracking',
        'App\Console\Commands\cronInetIT',
        'App\Console\Commands\cronReminderMYOB',
        'App\Console\Commands\cronApprovalFormRemoteAccessVPN',
        'App\Console\Commands\cronAllowOvertimesRemoteAcces19',
        'App\Console\Commands\setDurationForRemoteAccessVpn',
        'App\Console\Commands\remoteapproveGMvpn',
        'App\Console\Commands\cronCutExdoExpired',
        'App\Console\Commands\resetPasswordAllUser',
        'App\Console\Commands\resetEmail',
        'App\Console\Commands\testCronjob',
        'App\Console\Commands\cronAttendance',
        'App\Console\Commands\IT\ITAttendanceCrashedIn',
        'App\Console\Commands\IT\ITAttendnaceCrashedOut',
        'App\Console\Commands\ExdoLimiterExtends',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('birthday:email')
            ->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}