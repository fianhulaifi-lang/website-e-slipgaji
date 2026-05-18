<?php

namespace App\Exports;

use App\Models\SlipHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SlipHistoryExport implements FromCollection, WithHeadings
{
    protected $tanggal;

    public function __construct($tanggal = null)
    {
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        $query = SlipHistory::with('divisi');

        // FILTER BULAN
        if ($this->tanggal) {

            $tahun = substr($this->tanggal, 0, 4);
            $bulan = substr($this->tanggal, 5, 2);

            $query->whereYear('created_at', $tahun)
                  ->whereMonth('created_at', $bulan);
        }

        return $query->get()->map(function ($item) {
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