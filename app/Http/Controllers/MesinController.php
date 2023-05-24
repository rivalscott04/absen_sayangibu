<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MesinController extends Controller
{

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],  ['name' => "Data Mesin"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $data = Mesin::get();

        return view('pages.mesin', ['data' => $data], ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama" => "required",
            "ip_address" => "required|ip"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()->all()
            ], 501);
        }


        $data = new Mesin();
        $data->nama = $request->nama;
        $data->ip_address = $request->ip_address;
        $data->aktif = 0;
        $data->status = 0;

        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New Mesin Created',
            'data' => $data
        ], 201);
    }

    public function destroy($id){
        $data = Mesin::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Mesin Deleted',
            'data' => $data
        ], 200);
    }
}
