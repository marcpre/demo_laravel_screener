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
        Commands\InstrumentsCommand::class,
        Commands\FinancialsCommand::class,
        Commands\PricesCommand::class,
        Commands\ExchangesCommand::class,
        Commands\MarketsCommand::class,       
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
        $schedule->command('Instruments:download')->hourly();
        $schedule->command('Financials:download')->hourly();
        $schedule->command('Exchanges:download')->monthly();
        $schedule->command('Markets:download')->monthly();
        $schedule->command('Prices:download')->everyFiveMinutes();             
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
