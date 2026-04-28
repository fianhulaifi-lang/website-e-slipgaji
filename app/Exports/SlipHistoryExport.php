<?php

namespace App\Exports;

use App\Models\SlipHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SlipHistoryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SlipHistory::with('divisi')->get()->map(function ($item) {
            return [
                'Nama'     => $item->nama,
                'Email'    => $item->email,
                'Divisi'   => $item->divisi->nama_divisi ?? '-',
                'File'     => $item->file,
                'Status'   => $item->status,
                'Tanggal'  => $item->created_at->format('d-m-Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Divisi',
            'File',
            'Status',
            'Tanggal'
        ];
    }
}