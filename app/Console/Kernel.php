<?php

namespace App\Console;

use App\Models\Mesin;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Jadwal;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('inspire')->hourly();
    //     $schedule->command('arduino:update-status')->everyMinute();
    //     $schedule->call(function () {
    //         // Perform the route check here
    //         $response = Http::post('http://192.168.239.43');
    //         // Process the response or perform any desired actions
    //         if ($response->successful()) {
    //         // Route is accessible
    //         // Perform necessary actions
    //         } else {
    //         $data = Mesin::where('id', 1)->first();
    //         $data->aktif = 0;
    //         $data->update();
    //         }
    //     })->everyMinute();
    // }

    /**
     * Register the commands for the application.
     *
    //  * @return void
     */
    // protected function commands()
//     {
//         $this->load(__DIR__ . '/Commands');

//         require base_path('routes/console.php');
//     }

    protected function schedule(Schedule $schedule)
    {
        // Tugas untuk memperbarui jadwal sholat ketika hari berganti pada pukul 00:00
        $schedule->call(function () {
            // Mendapatkan tanggal hari ini dan besok
            $today = now()->format('Y/m/d');
            $tomorrow = now()->addDay()->format('Y-m-d');

            // Panggil API MyQuran untuk mendapatkan jadwal sholat besok
            $url = "https://api.myquran.com/v2/sholat/jadwal/1803/$today";
            $response = Http::get($url);
            $jadwalSholatData = $response->json()['data']['jadwal'];
            // dd($jadwalSholatData);

            $date = $jadwalSholatData['date'];

            // Membuat array untuk nama sholat
            $namaSholat = [
                'subuh' => 'Subuh',
                'dzuhur' => 'Dzuhur',
                'ashar' => 'Ashar',
                'maghrib' => 'Maghrib',
                'isya' => 'Isya'
            ];

            foreach($jadwalSholatData as $nama => $waktu){

                if($nama === 'tanggal' || $nama === 'date' || $nama === 'imsak' || $nama === 'terbit' || $nama === 'dhuha'){
                    continue;
                }

                $waktuMulai = Carbon::parse($waktu)->subMinutes(5);
                $waktuSelesai = Carbon::parse($waktu)->addMinutes(15);

                $status = now()->isBetween($waktuMulai, $waktuSelesai) ? 'Aktif' : 'Tidak Aktif';

                Jadwal::updateOrCreate(
                    [   'nama' => $namaSholat[$nama]],
                    [
                        'tanggal' => $date,
                        'waktu_mulai' => $waktuMulai,
                        'waktu_selesai' => $waktuSelesai,
                        'status' => $status
                    ]    
                );
            }
        })->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}



