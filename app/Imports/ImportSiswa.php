<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSiswa implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'kelas' => $row['kelas'],
            'kode' => $row['kode'],
            'kartu' => $row['kartu'],
            'foto'=> $row['foto'],
        ]);
    }
}
