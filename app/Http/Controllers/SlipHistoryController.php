<?php

namespace App\Http\Controllers;

use App\Models\SlipHistory;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Exports\SlipHistoryExport;
use Maatwebsite\Excel\Facades\Excel;

class SlipHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = SlipHistory::query();

        // FILTER DIVISI
        if ($request->divisi) {
            $query->where('divisi_id', $request->divisi);
        }

        // FILTER TANGGAL
        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $data = $query->latest()->get();

        return view('superadmin.slip.history', [
            'title'  => 'Riwayat Slip',
            'data'   => $data,
            'divisi' => Divisi::all()
        ]);
    }

    public function export()
    {
        return Excel::download(
            new SlipHistoryExport,
            'riwayat-slip.xlsx'
        );
    }
}