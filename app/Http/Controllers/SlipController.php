<?php

namespace App\Http\Controllers;

use App\Models\SlipHistory;
use App\Models\Karyawan;
use App\Models\Divisi;
use App\Models\SlipTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SlipMail;

class SlipController extends Controller
{
    // ================= HALAMAN UPLOAD =================
    public function create()
    {
        return view('superadmin.slip.create', [
            'title' => 'Kirim Slip Gaji'
        ]);
    }

    // ================= UPLOAD FILE =================
    public function upload(Request $request)
    {
        $request->validate([
            'file_slip'   => 'required',
            'file_slip.*' => 'file|mimes:pdf,png,jpg,jpeg'
        ]);

        foreach ($request->file('file_slip') as $file) {

           $nik = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

    // cek nik ada di tabel karyawan
    $cek = Karyawan::where('nik', $nik)->first();

    if (!$cek) {
        continue; // kalau nik tidak ada, skip
    }

    $date = now()->format('Y-m-d');

    $filename = $nik . '_' . time() . '.' . $file->getClientOriginalExtension();

    $file->storeAs('slip', $filename, 'public');

    SlipTemp::updateOrCreate(
        [
            'user_id' => Auth::id(),
            'nik' => $nik
        ],
        [
            'file_slip' => $filename,
            'upload_date' => $date
        ]
    );
}

        // tombol simpan
        if ($request->aksi == 'simpan') {
            return back()->with('success', 'File berhasil disimpan');
        }

        // tombol preview
        return redirect()->route('slipPreview');
    }

    // ================= PREVIEW =================
   public function preview(Request $request)
{
    $temps = SlipTemp::where('user_id', Auth::id())->get();

    $data = [];

    foreach ($temps as $item) {

        $karyawan = Karyawan::with('divisi')
            ->where('nik', $item->nik)
            ->first();

        if ($karyawan) {
            $data[] = [
                'nik'       => $item->nik,
                'nama'      => $karyawan->nama,
                'email'     => $karyawan->email,
                'divisi_id' => $karyawan->divisi_id,
                'divisi'    => $karyawan->divisi->nama_divisi ?? '-',
                'file'      => $item->file_slip,
                'date'      => $item->upload_date,
            ];
        }
    }

    // FILTER DIVISI
    if ($request->divisi) {
        $data = array_filter($data, function ($item) use ($request) {
            return $item['divisi_id'] == $request->divisi;
        });
    }
    

    // FILTER TANGGAL
    if ($request->date) {
        $data = array_filter($data, function ($item) use ($request) {
            return $item['date'] == $request->date;
        });
    }

    return view('superadmin.slip.preview', [
        'title'    => 'Preview Slip',
        'dataSlip' => $data,
        'divisi'   => Divisi::all()
    ]);
}

    // ================= KIRIM SATUAN =================
    public function store(Request $request)
    {
        $request->validate([
            'email_tujuan' => 'required|email',
            'nama'         => 'required'
        ]);

        $temp = SlipTemp::where('user_id', Auth::id())->first();

        if (!$temp) {
            return back()->with('error', 'Data slip tidak ditemukan');
        }

        try {

            Mail::to($request->email_tujuan)
                ->send(new SlipMail('slip/' . $temp->file_slip));

            SlipHistory::create([
                'nama'   => $request->nama,
                'email'  => $request->email_tujuan,
                'divisi_id' => $karyawan->divisi_id,
                'file'   => $temp->file_slip,
                'status' => 'terkirim'
            ]);

            SlipTemp::where('id', $temp->id)->delete();

            return redirect()->route('slipCreate')
                ->with('success', 'Slip berhasil dikirim');

        } catch (\Exception $e) {

            return back()->with('error', 'Gagal mengirim slip');
        }
    }

    // ================= KIRIM SEMUA =================
    public function storeAll()
    {
        $temps = SlipTemp::where('user_id', Auth::id())->get();

        foreach ($temps as $item) {

            $karyawan = Karyawan::where('nik', $item->nik)->first();

            if ($karyawan && $karyawan->email) {

                Mail::to($karyawan->email)
                    ->send(new SlipMail('slip/' . $item->file_slip));

                SlipHistory::create([
                    'nama'   => $karyawan->nama,
                    'email'  => $karyawan->email,
                    'divisi_id' => $karyawan->divisi_id,
                    'file'   => $item->file_slip,
                    'status' => 'terkirim'
                ]);
            }
        }

        // hapus semua temp
        SlipTemp::where('user_id', Auth::id())->delete();

        return redirect()->route('slipCreate')
            ->with('success', 'Semua slip berhasil dikirim');
    }

    // ================= KIRIM PER DIVISI =================
    public function storeDivisi(Request $request)
    {
        $temps = SlipTemp::where('user_id', Auth::id())->get();

        $nikTerkirim = [];

        foreach ($temps as $item) {

            $karyawan = Karyawan::with('divisi')
                ->where('nik', $item->nik)
                ->first();

            if (
                $karyawan &&
                $karyawan->divisi &&
                $karyawan->divisi->nama_divisi == $request->divisi
            ) {

                Mail::to($karyawan->email)
                    ->send(new SlipMail('slip/' . $item->file_slip));

                SlipHistory::create([
                    'nama'   => $karyawan->nama,
                    'email'  => $karyawan->email,
                    'divisi_id' => $karyawan->divisi_id,
                    'file'   => $item->file_slip,
                    'status' => 'terkirim'
                ]);

                $nikTerkirim[] = $item->nik;
            }
        }

        // hapus hanya divisi yang terkirim
        SlipTemp::where('user_id', Auth::id())
            ->whereIn('nik', $nikTerkirim)
            ->delete();

        return back()->with('success', 'Slip divisi berhasil dikirim');
    }
}