<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KaryawanExportData implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        $data = Karyawan::with('divisi', 'jabatan')
            ->orderBy('divisi_id')
            ->orderBy('nama')
            ->get();

        // Debug sementara — hapus setelah berhasil
        \Log::info('Total karyawan export: ' . $data->count());

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'NIK',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'No HP',
            'Alamat',
            'Jabatan',
            'Divisi',
        ];
    }

    public function map($karyawan): array
    {
        return [
            $karyawan->nama,
            $karyawan->email,
            $karyawan->nik,
            $karyawan->jenis_kelamin,
            \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d-m-Y'),
            $karyawan->no_hp,
            $karyawan->alamat,
            $karyawan->jabatan->nama_jabatan ?? '-',
            $karyawan->divisi->nama_divisi ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => [
                'fillType'   => 'solid',
                'startColor' => ['argb' => 'FF4472C4'],
            ],
        ]);

        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}