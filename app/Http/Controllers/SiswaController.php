<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class SiswaController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Attendance"], ['name' => "Data Siswa"],
        ];
        $pageConfigs = ['pageHeader' => true];
        $data = Siswa::latest()->get();
        return view('pages.attendance.siswa', ['data' => $data], ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function get($id)
    {
        $data = Siswa::where('id', $id)->first();
        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Detail Siswa Found',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Detail Siswa Not Found',
                'data' => null
            ], 404);
        }
    }

    public function getByNis($nis)
    {
        $data = Siswa::where('nis', $nis)->first();
        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Detail Siswa Found',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Detail Siswa Not Found',
                'data' => null
            ], 404);
        }
    }

    public function store(Request $request)
    {
        // return "OK";
        $validator = Validator::make($request->all(), [
            "nis" => "required",
            "nama" => "required",
            "kelas" => "required",
            "kode" => "required",
            "kartu" => "required",
            // "foto" => "required",
            'foto' => "required|mimes:jpg,jpeg,png|max:2048",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }

        // $fileName = $request->nis . '.' . $request->file->extension();
        // $request->file('foto')->storeAs('public/foto', $fileName);
        $file = $request->file('foto');
        $fileName = $request->nis . '.' . $file->extension();
        Storage::putFileAs('foto', $file, $fileName);

        $data = new Siswa();

        $data->nis = $request->nis;
        $data->nama = $request->nama;
        $data->kelas = $request->kelas;
        $data->kode = $request->kode;
        $data->kartu = $request->kartu;
        // $data->foto = $request->foto;
        $data->foto = $fileName;

        $data->save();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'New Siswa Created',
        //     'data' => $data
        // ], 200);
        return redirect()->route('siswa.index')->with('success', 'Data Berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nis" => "required",
            "nama" => "required",
            "kelas" => "required",
            "kode" => "required",
            "kartu" => "required",
            "foto" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }


        $data = Siswa::firstWhere('id', $id);
        if ($data) {
            // $data = new Siswa();

            $data->nis = $request->nis;
            $data->nama = $request->nama;
            $data->kelas = $request->kelas;
            $data->kode = $request->kode;
            $data->kartu = $request->kartu;
            $data->foto = $request->foto;

            $data->save();

            return response()->json([
                'status' => 'success',
                'message' => 'New Siswa Created',
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

    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Siswa Deleted',
            'data' => null
        ], 200);
    }
}
