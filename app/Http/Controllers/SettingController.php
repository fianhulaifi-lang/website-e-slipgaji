<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy(function ($item) {
            $kepegawaian = ['usia_pensiun','jatah_cuti_default','masa_kontrak_default','status_pegawai_options','status_aktif_options','golongan_options'];
            $bank        = ['bank_options','max_bank'];
            $anak        = ['max_anak'];
            $pribadi     = ['agama_options','status_nikah_options','jaminan_kesehatan_options'];
            $pendidikan  = ['pendidikan_terakhir_options'];

            if (in_array($item->key, $kepegawaian)) return 'Kepegawaian';
            if (in_array($item->key, $bank))        return 'Bank';
            if (in_array($item->key, $anak))        return 'Data Anak';
            if (in_array($item->key, $pribadi))     return 'Data Pribadi';
            if (in_array($item->key, $pendidikan))  return 'Pendidikan';
            return 'Lainnya';
        });

        $data = [
            'title'    => 'Pengaturan Sistem',
            'settings' => $settings,
        ];

        return view('superadmin.setting.index', $data);
    }

    public function update(Request $request)
    {
        foreach ($request->settings as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan');
    }
}