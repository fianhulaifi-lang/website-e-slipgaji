<?php

namespace App\Models;

use App\Models\KaryawanAnak;
use App\Models\KaryawanBank;
use App\Models\KaryawanKeluarga;
use App\Models\KaryawanPendidikan;
use App\Models\KaryawanPribadi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $connection = 'db_induk';
    protected $table = 'karyawans';

    protected $fillable = [
        'nik', 'no_absen', 'golongan', 'nama', 'nama_panggilan',
        'email', 'no_ktp', 'no_hp', 'alamat',
        'jenis_kelamin', 'tanggal_lahir',
        'jabatan_id', 'divisi_id',
        'status_pegawai', 'status_aktif',
        'tanggal_masuk', 'tanggal_pengangkatan', 'tanggal_pensiun',
        'masa_kerja', 'jatah_cuti', 'sisa_cuti',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

   public function pribadi()
{
    return $this->hasOne(KaryawanPribadi::class, 'karyawan_id')->withDefault();
}

public function pendidikan()
{
    return $this->hasOne(KaryawanPendidikan::class, 'karyawan_id')->withDefault();
}

public function keluarga()
{
    return $this->hasOne(KaryawanKeluarga::class, 'karyawan_id')->withDefault();
}

    public function bank()
    {
        return $this->hasMany(KaryawanBank::class, 'karyawan_id');
    }

    public function anak()
    {
        return $this->hasMany(KaryawanAnak::class, 'karyawan_id');
    }
}