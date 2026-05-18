<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryawanAnak extends Model
{
    protected $connection = 'db_induk';
    protected $table = 'karyawan_anak';

    protected $fillable = [
        'karyawan_id', 'nama', 'tempat_lahir',
        'tanggal_lahir', 'pekerjaan', 'jenis_kelamin', 'pendidikan'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}