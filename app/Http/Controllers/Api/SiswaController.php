<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::get();
        return response()->json([
            'status' => 'success',
            'message' => 'List of Siswa',
            'data' => $data
        ], 200);
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
        // return $request;
        $validator = Validator::make($request->all(), [
            "nis" => "required",
            "nama" => "required",
            "jenis_kelamin" => "required",
            "kelas" => "required",
            "kode" => "required",
            "kartu" => "required",
            'foto' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }

        $cekNis = Siswa::firstWhere('nis', $request->nis);
        if ($cekNis) {
            return response()->json([
                'status' => 'Error',
                'message' => 'NIS Exists',
                'data' => $cekNis
            ], 200);
        }

        if ($request->foto != null) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->extension();
            Storage::putFileAs('foto', $file, $fileName);
        } else {
            // $fileName = public_path('images/3.png');
            // Storage::putFileAs('foto', $file, $fileName);
            $defaultPhoto = public_path('images/3.png');
            $fileName = basename($defaultPhoto);
            Storage::put('foto/' . $fileName, file_get_contents($defaultPhoto));
        }

        $data = new Siswa();
        $data->nis = $request->nis;
        $data->nama = $request->nama;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->kelas = $request->kelas;
        $data->kode = $request->kode;
        $data->kartu = $request->kartu;
        $data->foto = $fileName;

        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New Siswa Created',
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // return $id;
        $validator = Validator::make($request->all(), [
            "nis" => "required",
            "nama" => "required",
            "jenis_kelamin" => "required",
            "kelas" => "required",
            "kode" => "required",
            "kartu" => "required",
            'foto_edit' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }

        $data = Siswa::firstWhere('id', $id);
        if ($data) {
            if ($request->foto_edit == null) {
                if ($data->foto == 'person.png') {
                    $fileName = 'person.png';
                } else {
                    $fileName = $data->foto;
                }
            } else {
                if ($data->foto != 'person.png') {
                    Storage::delete('foto/' . $data->foto);
                }
                $file = $request->file('foto_edit');
                $fileName = time() . '.' . $file->extension();
                Storage::putFileAs('foto', $file, $fileName);
            }

            $data->nis = $request->nis;
            $data->nama = $request->nama;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->kelas = $request->kelas;
            $data->kode = $request->kode;
            $data->kartu = $request->kartu;
            $data->foto = $fileName;

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

    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);
        if ($data->foto != 'person.png') {
            Storage::delete('foto/' . $data->foto);
        }
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Siswa Deleted',
            'data' => null
        ], 200);
    }
}
