<?php

namespace App\Http\Controllers;

use App\Models\SlipHistory;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SlipMail;

class SlipController extends Controller
{
    public function create()
    {
        return view('superadmin.slip.create', [
            'title' => 'Kirim Slip Gaji'
        ]);
    }

    public function preview(Request $request)
    {
        $request->validate([
            'file_slip' => 'required|mimes:pdf,jpg,png|max:2048'
        ]);

        // Simpan file ke storage
        $file = $request->file('file_slip')->store('slip', 'public');

        // Simpan ke session
        session([
            'file_slip' => $file
        ]);

        // Ambil data karyawan
        $karyawan = Karyawan::all();

        return view('superadmin.slip.preview', [
            'title' => 'Preview Slip Gaji',
            'file' => $file,
            'karyawan' => $karyawan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email_tujuan' => 'required|email',
            'nama' => 'required'
        ]);

        $file = session('file_slip');

        if (!$file) {
            return redirect()->route('slipCreate')
                ->with('error', 'File tidak ditemukan');
        }

        try {
            Mail::to($request->email_tujuan)
                ->send(new SlipMail($file));

            // Simpan riwayat sukses
            SlipHistory::create([
                'nama' => $request->nama,
                'email' => $request->email_tujuan,
                'file' => $file,
                'status' => 'terkirim'
            ]);

            session()->forget('file_slip');

            return redirect()->route('slipCreate')
                ->with('success', 'Slip berhasil dikirim');

        } catch (\Exception $e) {

            // Simpan riwayat gagal
            SlipHistory::create([
                'nama' => $request->nama,
                'email' => $request->email_tujuan,
                'file' => $file,
                'status' => 'gagal'
            ]);

            return redirect()->route('slipCreate')
                ->with('error', 'Gagal mengirim slip');
        }
    }
}