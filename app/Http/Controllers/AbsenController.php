<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    //
    public function index()
    {
        $data = Absen::get();

        return view('pages.attendance.kehadiran', compact('data'));
    }

    public function store ($id){
        $data = 

    }

}
