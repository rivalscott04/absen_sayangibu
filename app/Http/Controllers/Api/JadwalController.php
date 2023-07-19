<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Guzwrap\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $data = Jadwal::get();
        return response()->json([
            'status' => 'success',
            'message' => 'List of Jadwal',
            'data' => $data
        ], 200);
    }

    public function postJadwalSholat(){

            $today = Carbon::now()->format('Y/m/d');
            // $tomorrow = now()->addDay()->format('Y/m/d');

            // Panggil API MyQuran untuk mendapatkan jadwal sholat besok
            $url = "https://api.myquran.com/v1/sholat/jadwal/1803/$today";
            $response = Http::get($url);
            $jadwalSholatData = $response->json();
            dd($jadwalSholatData);


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

            $this->updateStatus();

            return response()->json([
                'status' => 'success',
                'message' => 'get jadwal sholat',
                'data' => $jadwalSholatData
            ], 200);

    }

    public function updateStatus()
    {
        $jadwalSholat = Jadwal::all();

        foreach ($jadwalSholat as $jadwal) {
            $waktuMulai = Carbon::parse($jadwal->waktu_mulai);
            $waktuSelesai = Carbon::parse($jadwal->waktu_selesai);

            $status = now()->isBetween($waktuMulai, $waktuSelesai) ? 'Aktif' : 'Tidak Aktif';

            $jadwal->status = $status;
            $jadwal->save();
        }
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         "nama" => "required",
    //         "tanggal" => "required",
    //         "waktu_mulai" => "required",
    //         "waktu_selesai" => "required",
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'Error',
    //             'message' => $validator->messages()->all()
    //         ], 501);
    //     }


    //     $data = new Jadwal();
    //     $data->nama = $request->nama;
    //     $data->tanggal = $request->tanggal;
    //     $data->waktu_mulai = $request->waktu_mulai;
    //     $data->waktu_selesai = $request->waktu_selesai;
    //     $data->aktif = 0;
    //     $data->status = 0;

    //     $data->save();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'New Mesin Created',
    //         'data' => $data
    //     ], 201);
    // }


    // public function update(Request $request, $id)
    // {
    //     // return $id;
    //     $validator = Validator::make($request->all(), [
    //         "nama" => "required",
    //         "tanggal" => "required",
    //         "waktu_mulai" => "required",
    //         "waktu_selesai" => "required",
    //         "aktif" => "required",
    //         // "status" => "required",
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'Error',
    //             'message' => $validator->messages()->all()
    //         ], 501);
    //     }

    //     $data = Jadwal::firstWhere('id', $id);
    //     if ($data) {
    //         $data->nama = $request->nama;
    //         $data->tanggal = $request->tanggal;
    //         $data->waktu_mulai = $request->waktu_mulai;
    //         $data->waktu_selesai = $request->waktu_selesai;
    //         $data->aktif = $request->aktif;
    //         $data->status = 0;
    //         $data->update();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Jadwal Updated',
    //             'data' => $data
    //         ], 201);
    //     } else {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Jadwal Not Found',
    //             'data' => null
    //         ], 404);
    //     }
    // }

    public function destroy($id)
    {
        $data = Jadwal::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal Deleted',
            'data' => null
        ], 200);
    }
}
