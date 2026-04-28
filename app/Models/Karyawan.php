<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $connection = 'db_induk';
    protected $table = 'karyawans';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'jabatan_id',
        'divisi_id'
    ];

    public function divisi()
{
    return $this->belongsTo(Divisi::class, 'divisi_id');
}

public function jabatan()
{
    return $this->belongsTo(Jabatan::class, 'jabatan_id');
}
}