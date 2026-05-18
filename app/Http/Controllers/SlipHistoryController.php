<?php

namespace App\Http\Controllers;

use App\Models\SlipHistory;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Exports\SlipHistoryExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class SlipHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = SlipHistory::with('divisi');

        // Filter Divisi
        if ($request->filled('divisi')) {
            $query->where('divisi_id', $request->divisi);
        }

        // Filter Bulan
        if ($request->filled('tanggal')) {
            try {
                $date = Carbon::createFromFormat('Y-m', $request->tanggal);
                $query->whereYear('created_at', $date->year)
                      ->whereMonth('created_at', $date->month);
            } catch (\Exception $e) {
                // abaikan jika format salah
            }
        }

        $data = $query->latest()->get();

        return view('superadmin.slip.history', [
            'title'  => 'Riwayat Slip',
            'data'   => $data,
            'divisi' => Divisi::all()
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(
            new SlipHistoryExport($request->tanggal),
            'riwayat-slip.xlsx'
        );
    }

    // Hapus data berdasarkan bulan yang dipilih
    public function destroyBulk(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
        ]);

        try {
            $date = Carbon::createFromFormat('Y-m', $request->tanggal);
        } catch (\Exception $e) {
            return back()->with('info', 'Format bulan tidak valid.');
        }

        $jumlah = SlipHistory::whereYear('created_at', $date->year)
                             ->whereMonth('created_at', $date->month)
                             ->count();

        if ($jumlah == 0) {
            return back()->with('info', 'Tidak ada data riwayat pada bulan ' . $date->translatedFormat('F Y') . '.');
        }

        SlipHistory::whereYear('created_at', $date->year)
                   ->whereMonth('created_at', $date->month)
                   ->delete();

        return back()->with('success', "Berhasil menghapus {$jumlah} data riwayat bulan " . $date->translatedFormat('F Y') . '.');
    }

    public function destroy($id)
    {
        $data = SlipHistory::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }
}