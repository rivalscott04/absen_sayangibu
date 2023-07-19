<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Siswa;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsenController extends Controller
{
    public function index()
    {
        $data = Absen::with('siswa')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'List of Absen',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            "kartu_id" => "required",
            "no_mesin" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }

        $siswa = Siswa::where('kartu', $request->kartu_id)->first();
        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Card Not Found',
                'data' => null
            ], 404);
        }

        $today = Carbon::now()->format('Y-m-d');
        $jadwalAktif = Jadwal::where('status', 'Aktif')
            ->first();

        if (!$jadwalAktif) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jadwal Tidak Aktif',
                'data' => null
            ], 404);
        }
        
        $waktuMulaiAbsen = $jadwalAktif->waktu_mulai;
        $waktuTutupAbsen = $jadwalAktif->waktu_selesai;

        $data = new Absen();
        $data->nis_id = $siswa->nis;
        $data->kartu_id = $request->kartu_id;
        $data->nama = $siswa->nama;
        $data->tanggal = $today;
        $data->kelas = "A";
        $data->no_mesin = $request->no_mesin;
        $data->jam_absen = Carbon::now()->format('H:i:m');
        $data->waktu_mulai = $waktuMulaiAbsen;
        $data->waktu_selesai = $waktuTutupAbsen;

        // Status : 
        // 0 = Tidak Masuk
        // 1 = Masuk tepat Waktu
        // 2 = Masuk telat
        if ($data->jam_absen >= $data->waktu_mulai && $data->jam_absen <= $data->waktu_selesai) {
            $data->status = 1;
        } else{
            $data->status = 2;
        }

        $data->save();
        return response()->json([
            'status' => 'success',
            'message' => 'New Absen Created',
            'data' => $data
        ], 201);
    }
}
