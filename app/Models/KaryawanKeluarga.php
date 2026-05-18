<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryawanKeluarga extends Model
{
    protected $connection = 'db_induk';
    protected $table = 'karyawan_keluarga';

    protected $fillable = [
        'karyawan_id',
        'nama_ayah', 'nama_ibu',
        'nama_pasangan', 'tempat_lahir_pasangan', 'tanggal_lahir_pasangan',
        'pekerjaan_pasangan', 'jenis_kelamin_pasangan', 'pendidikan_pasangan',
        'jaminan_kesehatan',
    ];
}