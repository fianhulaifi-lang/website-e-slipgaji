<?php

namespace App\Imports;

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Divisi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class KaryawanImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $jabatan = Jabatan::whereRaw('LOWER(nama_jabatan) = ?', [strtolower($row['jabatan'])])->first();
        $divisi  = Divisi::whereRaw('LOWER(nama_divisi) = ?', [strtolower($row['divisi'])])->first();

        // ✅ Konversi tanggal dari format Excel (angka serial) ke Y-m-d
        $tanggalLahir = $row['tanggal_lahir'];

        if (is_numeric($tanggalLahir)) {
            // Angka serial Excel → Carbon
            $tanggalLahir = Carbon::instance(Date::excelToDateTimeObject($tanggalLahir))->format('Y-m-d');
        } else {
            // Jika sudah string, parse langsung
            $tanggalLahir = Carbon::parse($tanggalLahir)->format('Y-m-d');
        }

        return new Karyawan([
            'nama'           => $row['nama'],
            'email'          => $row['email'],
            'nik'            => $row['nik'],
            'jenis_kelamin'  => $row['jenis_kelamin'],
            'tanggal_lahir'  => $tanggalLahir,
            'no_hp'          => $row['no_hp'],
            'alamat'         => $row['alamat'],
            'jabatan_id'     => $jabatan?->id,
            'divisi_id'      => $divisi?->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama'          => 'required',
            'email'         => 'required|email|unique:db_induk.karyawans,email',
            'nik'           => 'required|unique:db_induk.karyawans,nik',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp'         => 'required',
            'alamat'        => 'required',
            'jabatan'       => 'required',
            'divisi'        => 'required',
        ];
    }
}