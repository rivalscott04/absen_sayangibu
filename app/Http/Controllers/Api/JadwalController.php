<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama" => "required",
            "tanggal" => "required",
            "waktu_mulai" => "required",
            "waktu_selesai" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }


        $data = new Jadwal();
        $data->nama = $request->nama;
        $data->tanggal = $request->tanggal;
        $data->waktu_mulai = $request->waktu_mulai;
        $data->waktu_selesai = $request->waktu_selesai;
        $data->aktif = 0;
        $data->status = 0;

        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New Mesin Created',
            'data' => $data
        ], 201);
    }


    public function update(Request $request, $id)
    {
        // return $id;
        $validator = Validator::make($request->all(), [
            "nama" => "required",
            "tanggal" => "required",
            "waktu_mulai" => "required",
            "waktu_selesai" => "required",
            "aktif" => "required",
            // "status" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }

        $data = Jadwal::firstWhere('id', $id);
        if ($data) {
            $data->nama = $request->nama;
            $data->tanggal = $request->tanggal;
            $data->waktu_mulai = $request->waktu_mulai;
            $data->waktu_selesai = $request->waktu_selesai;
            $data->aktif = $request->aktif;
            $data->status = 0;
            $data->update();

            return response()->json([
                'status' => 'success',
                'message' => 'Jadwal Updated',
                'data' => $data
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Jadwal Not Found',
                'data' => null
            ], 404);
        }
    }

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
