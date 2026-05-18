<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryawanPribadi extends Model
{
    protected $connection = 'db_induk';
    protected $table = 'karyawan_pribadi';

    protected $fillable = [
        'karyawan_id', 'agama', 'suku',
        'tempat_lahir', 'status_nikah', 'hobby',
    ];
}