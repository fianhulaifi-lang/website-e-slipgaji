<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryawanPendidikan extends Model
{
    protected $connection = 'db_induk';
    protected $table = 'karyawan_pendidikan';

    protected $fillable = [
        'karyawan_id', 'sd', 'sltp', 'slta', 'pt',
        'pendidikan_terakhir', 'jurusan', 'tahun_masuk', 'tahun_keluar',
    ];
}