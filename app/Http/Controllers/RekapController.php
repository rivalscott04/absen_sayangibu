<?php

namespace App\Http\Controllers;

use App\Exports\RekapExport;
use App\Models\Absen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $query = Absen::query();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        // Melakukan filter berdasarkan user_id jika input user_id tersedia
        if ($request->filled('nis_id')) {
            $query->where('nis_id', $request->nis_id);
        }

        // Mengambil hasil query
        $rekaps = $query->get();

        // Menampilkan view 'transactions.index' dengan data transactions
        return view('pages.attendance.rekap', compact('rekaps'));
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'List of Rekap',
        //     'data' => $rekaps
        // ], 200);
    }

    public function export(Request $request)
    {
        $query = Absen::query();  // Ganti dengan model yang sesuai

        if ($request->has('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }
        if ($request->has('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }
        if ($request->has('nis_id')) {
            $query->where('nis_id', $request->nis_id);
        }

        return Excel::download(new RekapExport($query), 'rekap.xlsx');
    }
}
