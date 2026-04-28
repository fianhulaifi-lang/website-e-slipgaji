<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KaryawanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Karyawan::with('divisi', 'jabatan')->get();
    }

    public function map($karyawan): array
    {
        return [
            $karyawan->nama,
            $karyawan->email,
            $karyawan->nik,
            $karyawan->no_hp,
            $karyawan->alamat,
            $karyawan->jabatan->nama_jabatan ?? '-',
            $karyawan->divisi->nama_divisi ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'NIK',
            'No HP',
            'Alamat',
            'Jabatan',
            'Divisi',
        ];
    }
}