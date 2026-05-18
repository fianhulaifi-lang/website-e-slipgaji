<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KaryawanExport implements FromArray, WithHeadings, WithStyles
{
    // Hanya header, tidak ada data
    public function array(): array
    {
        return [];
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