<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = "absen";

    function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis_id', 'nis')->select('nis', 'nama');
    }
}
