<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index()
    {
        $data = Jadwal::latest()->get();
        return view('pages.jadwal', compact('data'));
    }
}
