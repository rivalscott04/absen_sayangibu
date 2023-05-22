<?php

namespace App\Console;

use App\Models\Mesin;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;

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
        // $schedule->command('inspire')->hourly();
        // $schedule->command('arduino:update-status')->everyMinute();
        $schedule->call(function () {
            // Perform the route check here
            // $response = Http::post('http://192.168.239.43');
            // Process the response or perform any desired actions
            // if ($response->successful()) {
            // Route is accessible
            // Perform necessary actions
            // } else {
            $data = Mesin::where('id', 1)->first();
            $data->aktif = 0;
            $data->update();
            // }
        })->everyMinute();
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
