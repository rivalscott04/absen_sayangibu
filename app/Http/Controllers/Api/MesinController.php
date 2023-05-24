<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MesinController extends Controller
{

    public function index()
    {
        $data = Mesin::get();
        return response()->json([
            'status' => 'success',
            'message' => 'List of Mesin',
            'data' => $data
        ], 200);
    }

    public function cekMesin(Request $request)
    {
        // return $request;
        $data = Mesin::firstWhere('id', $request->mesin);
        if ($data) {

            $data->ip_address = $request->ip_address;
            $data->aktif = 1;
            $data->ip_address = $request->ip_address;
            $data->update();

            return response()->json([
                'status' => 'success',
                'message' => 'Siswa Updated',
                'data' => $data
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Siswa Not Found',
                'data' => null
            ], 404);
        }
    }
    public function mesinNih()
    {
        $data = Mesin::where('id', 1)->first();
        $data->aktif = 0;
        $data->update();
        return "OK";
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }


        $data = new Mesin();
        $data->nama = $request->nama;
        $data->ip_address = "0.0.0.0";
        $data->aktif = 0;
        $data->status = 0;

        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New Mesin Created',
            'data' => $data
        ], 201);
    }
}
