<?php

namespace App\Exports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RekapExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function map($rekap): array
    {
        return [
            $rekap->nama,
            $rekap->tanggal,
            $rekap->kelas,
            $rekap->waktu_mulai,
            $rekap->waktu_selesai,
            $rekap->jam_absen,
            $rekap->status
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Tanggal',
            'Kelas',
            'Waktu Mulai',
            'Waktu Selesai',
            'Jam Absen',
            'Status'
        ];
    }
}
