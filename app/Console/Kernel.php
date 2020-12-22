<?php

namespace App\Console;

use App\Jobs\SendEmailJob;
use App\Traits\MyFrequencies;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
// use Illuminate\Console\Scheduling\ManagesFrequencies;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    use MyFrequencies;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    private function everySecondTuesdayMonthly($time = '0:0')
    {
        $this->dailyAt($time);

        $now = Carbon::now();
        $month = $now->format('F');
        $year = $now->format('yy');

        $secondTuesdayMonthly = new Carbon('second tuesday of ' . $month . ' ' . $year);

        return $this->spliceIntoPosition(3, $secondTuesdayMonthly->day);
    }

    /**
     * Define the application's command schedule.
     *
    //  * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
    //  * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $now = Carbon::now();
        $month = $now->format('F');
        $year = $now->format('yy');

        $secondTuesdayMonthly = new Carbon('second tuesday of ' . $month . ' ' . $year);

        $schedule->job(new SendEmailJob)->everyMinute()->monthlyOn($secondTuesdayMonthly->format('d'), '00:15');
        // $schedule->job(new SendEmailJob, 'sendemailjob', 'redis')->monthlyOn($secondTuesdayMonthly->format('d'), '00:15');
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
