<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryawanBank extends Model
{
    protected $connection = 'db_induk';
    protected $table = 'karyawan_bank';

    protected $fillable = ['karyawan_id', 'bank', 'no_rekening', 'atas_nama'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}