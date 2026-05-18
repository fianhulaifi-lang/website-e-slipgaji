<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Exports\KaryawanExport;
use App\Exports\KaryawanExportData;
use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    // ── Helper: kumpulkan semua setting untuk dikirim ke blade ──────
    private function getSettings(): array
    {
        return [
            'usiaPensiun'          => Setting::getInt('usia_pensiun', 55),
            'jatahCutiDefault'     => Setting::getInt('jatah_cuti_default', 12),
            'bankOptions'          => Setting::getArray('bank_options', ['BCA','BNI','BRI','Mandiri','BSI','CIMB Niaga','Danamon','BTN','Permata']),
            'statusPegawaiOptions' => Setting::getArray('status_pegawai_options', ['TETAP','KONTRAK','MAGANG']),
            'statusAktifOptions'   => Setting::getArray('status_aktif_options', ['AKTIF','NON AKTIF']),
            'agamaOptions'         => Setting::getArray('agama_options', ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu']),
            'statusNikahOptions'   => Setting::getArray('status_nikah_options', ['BELUM MENIKAH','MENIKAH','CERAI']),
            'pendidikanOptions'    => Setting::getArray('pendidikan_terakhir_options', ['SD','SMP','SMA/SMK','D1','D2','D3','S1','S2','S3','Paket C']),
            'jaminanOptions'       => Setting::getArray('jaminan_kesehatan_options', ['tercover','tidak tercover']),
            'golonganOptions'      => Setting::getArray('golongan_options', ['IA','IB','IC','ID','IIA','IIB','IIC','IID','IIIA','IIIB','IIIC','IIID','IVA','IVB','IVC','IVD','IVE']),
        ];
    }

    public function index(Request $request)
    {
        $query = Karyawan::with('divisi', 'jabatan');

        if ($request->divisi) {
            $query->where('divisi_id', $request->divisi);
        }

        $data = array(
            'title'                  => 'Data Karyawan',
            'menuSuperadminKaryawan' => 'active',
            'karyawan' => $query->orderBy('divisi_id')->orderBy('nama', 'asc')->get(),
            'divisi'   => Divisi::orderBy('nama_divisi', 'asc')->get(),
            'jabatan'  => Jabatan::all(),
        );

        return view('superadmin.karyawan.index', $data);
    }

    public function create()
    {
        $data = array_merge($this->getSettings(), [
            'title'                  => 'Tambah Data Karyawan',
            'menuSuperadminKaryawan' => 'active',
            'divisi'                 => Divisi::all(),
            'jabatan'                => Jabatan::all(),
        ]);

        return view('superadmin.karyawan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'email'         => 'required|unique:db_induk.karyawans,email',
            'nik'           => 'required|unique:db_induk.karyawans,nik',
            'no_hp'         => 'required',
            'alamat'        => 'required',
            'jabatan_id'    => 'required',
            'divisi_id'     => 'required',

        ]);

        // Ambil setting pensiun dari DB
        $usiaPensiun = Setting::getInt('usia_pensiun', 55);

        // ── 1. Tabel utama karyawans ────────────────────────────────
        $karyawan = Karyawan::create([
            'nik'                  => $request->nik,
            'no_absen'             => $request->no_absen,
            'golongan'             => $request->golongan,
            'nama'                 => $request->nama,
            'nama_panggilan'       => $request->nama_panggilan,
            'email'                => $request->email,
            'no_ktp'               => $request->no_ktp,
            'no_hp'                => $request->no_hp,
            'alamat'               => $request->alamat,
            'jenis_kelamin'        => $request->jenis_kelamin,
            'tanggal_lahir'        => $request->tanggal_lahir,
            'jabatan_id'           => $request->jabatan_id,
            'divisi_id'            => $request->divisi_id,
            'status_pegawai'       => $request->status_pegawai,
            'status_aktif'         => $request->status_aktif,
            'masa_kerja'           => $request->masa_kerja,
            'tanggal_masuk'        => $request->tanggal_masuk,
            'tanggal_pengangkatan' => $request->tanggal_pengangkatan,
            'tanggal_pensiun'      => ($request->status_pegawai == 'TETAP' && $request->tanggal_lahir)
                                        ? Carbon::parse($request->tanggal_lahir)->addYears($usiaPensiun)
                                        : null,
            'jatah_cuti'           => $request->jatah_cuti ?? Setting::getInt('jatah_cuti_default', 12),
            'sisa_cuti'            => $request->sisa_cuti  ?? Setting::getInt('jatah_cuti_default', 12),
        ]);

        // ── 2. Data Pribadi (karyawan_pribadi) ──────────────────────
        $karyawan->pribadi()->create([
            'agama'        => $request->agama,
            'suku'         => $request->suku,
            'tempat_lahir' => $request->tempat_lahir,
            'status_nikah' => $request->status_nikah,
            'hobby'        => $request->hobby,
        ]);

        // ── 3. Pendidikan (karyawan_pendidikan) ─────────────────────
        $karyawan->pendidikan()->create([
            'sd'                  => $request->pendidikan_sd,
            'sltp'                => $request->pendidikan_sltp,
            'slta'                => $request->pendidikan_slta,
            'pt'                  => $request->pendidikan_pt,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jurusan'             => $request->jurusan,
            'tahun_masuk'         => $request->tahun_masuk_kuliah,
            'tahun_keluar'        => $request->tahun_keluar_kuliah,
        ]);

        // ── 4. Keluarga (karyawan_keluarga) ─────────────────────────
        $karyawan->keluarga()->create([
            'nama_ayah'              => $request->nama_ayah,
            'nama_ibu'               => $request->nama_ibu,
            'nama_pasangan'          => $request->nama_pasangan,
            'tempat_lahir_pasangan'  => $request->tempat_lahir_pasangan,
            'tanggal_lahir_pasangan' => $request->tanggal_lahir_pasangan ?: null,
            'pekerjaan_pasangan'     => $request->pekerjaan_pasangan,
            'jenis_kelamin_pasangan' => $request->jenis_kelamin_pasangan,
            'pendidikan_pasangan'    => $request->pendidikan_pasangan,
            'jaminan_kesehatan'      => $request->jaminan_kesehatan,
        ]);

        // ── 5. Bank (karyawan_bank) — bisa banyak baris ─────────────
        foreach ($request->bank ?? [] as $i => $bank) {
            if (!empty($bank) || !empty($request->no_rekening[$i])) {
                $karyawan->bank()->create([
                    'bank'        => $bank,
                    'no_rekening' => $request->no_rekening[$i] ?? null,
                    'atas_nama'   => $request->atas_nama[$i] ?? null,
                ]);
            }
        }

        // ── 6. Anak (karyawan_anak) — bisa banyak baris ─────────────
        foreach ($request->nama_anak ?? [] as $i => $nama) {
            if (!empty($nama)) {
                $karyawan->anak()->create([
                    'nama'          => $nama,
                    'tempat_lahir'  => $request->tempat_lahir_anak[$i] ?? null,
                    'tanggal_lahir' => $request->tanggal_lahir_anak[$i] ?: null,
                    'pekerjaan'     => $request->pekerjaan_anak[$i] ?? null,
                    'jenis_kelamin' => $request->jenis_kelamin_anak[$i] ?? null,
                    'pendidikan'    => $request->pendidikan_anak[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('karyawan')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = array_merge($this->getSettings(), [
            'title'                  => 'Edit Data Karyawan',
            'menuSuperadminKaryawan' => 'active',
            'karyawan'               => Karyawan::with('pribadi', 'pendidikan', 'keluarga', 'bank', 'anak')
                                            ->findOrFail($id),
            'divisi'                 => Divisi::all(),
            'jabatan'                => Jabatan::all(),
        ]);

        return view('superadmin.karyawan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'email'         => 'required|unique:db_induk.karyawans,email,' . $id,
            'nik'           => 'required|unique:db_induk.karyawans,nik,' . $id,
            'no_hp'         => 'required',
            'alamat'        => 'required',
            'jabatan_id'    => 'required',
            'divisi_id'     => 'required',
        ]);

        // Ambil setting pensiun dari DB
        $usiaPensiun = Setting::getInt('usia_pensiun', 55);
        $karyawan    = Karyawan::findOrFail($id);

        // ── 1. Tabel utama karyawans ────────────────────────────────
        $karyawan->update([
            'nik'                  => $request->nik,
            'no_absen'             => $request->no_absen,
            'golongan'             => $request->golongan,
            'nama'                 => $request->nama,
            'nama_panggilan'       => $request->nama_panggilan,
            'email'                => $request->email,
            'no_ktp'               => $request->no_ktp,
            'no_hp'                => $request->no_hp,
            'alamat'               => $request->alamat,
            'jenis_kelamin'        => $request->jenis_kelamin,
            'tanggal_lahir'        => $request->tanggal_lahir,
            'jabatan_id'           => $request->jabatan_id,
            'divisi_id'            => $request->divisi_id,
            'status_pegawai'       => $request->status_pegawai,
            'status_aktif'         => $request->status_aktif,
            'masa_kerja'           => $request->masa_kerja,
            'tanggal_masuk'        => $request->tanggal_masuk,
            'tanggal_pengangkatan' => $request->tanggal_pengangkatan,
            'tanggal_pensiun'      => ($request->status_pegawai == 'TETAP' && $request->tanggal_lahir)
                                        ? Carbon::parse($request->tanggal_lahir)->addYears($usiaPensiun)
                                        : null,
            'jatah_cuti'           => $request->jatah_cuti,
            'sisa_cuti'            => $request->sisa_cuti,
        ]);

        // ── 2. Data Pribadi ─────────────────────────────────────────
        $karyawan->pribadi()->updateOrCreate(
            ['karyawan_id' => $karyawan->id],
            [
                'agama'        => $request->agama,
                'suku'         => $request->suku,
                'tempat_lahir' => $request->tempat_lahir,
                'status_nikah' => $request->status_nikah,
                'hobby'        => $request->hobby,
            ]
        );

        // ── 3. Pendidikan ───────────────────────────────────────────
        $karyawan->pendidikan()->updateOrCreate(
            ['karyawan_id' => $karyawan->id],
            [
                'sd'                  => $request->pendidikan_sd,
                'sltp'                => $request->pendidikan_sltp,
                'slta'                => $request->pendidikan_slta,
                'pt'                  => $request->pendidikan_pt,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'jurusan'             => $request->jurusan,
                'tahun_masuk'         => $request->tahun_masuk_kuliah,
                'tahun_keluar'        => $request->tahun_keluar_kuliah,
            ]
        );

        // ── 4. Keluarga ─────────────────────────────────────────────
        $karyawan->keluarga()->updateOrCreate(
            ['karyawan_id' => $karyawan->id],
            [
                'nama_ayah'              => $request->nama_ayah,
                'nama_ibu'               => $request->nama_ibu,
                'nama_pasangan'          => $request->nama_pasangan,
                'tempat_lahir_pasangan'  => $request->tempat_lahir_pasangan,
                'tanggal_lahir_pasangan' => $request->tanggal_lahir_pasangan ?: null,
                'pekerjaan_pasangan'     => $request->pekerjaan_pasangan,
                'jenis_kelamin_pasangan' => $request->jenis_kelamin_pasangan,
                'pendidikan_pasangan'    => $request->pendidikan_pasangan,
                'jaminan_kesehatan'      => $request->jaminan_kesehatan,
            ]
        );

        // ── 5. Bank — hapus lama, isi ulang ─────────────────────────
        $karyawan->bank()->delete();
        foreach ($request->bank ?? [] as $i => $bank) {
            if (!empty($bank) || !empty($request->no_rekening[$i])) {
                $karyawan->bank()->create([
                    'bank'        => $bank,
                    'no_rekening' => $request->no_rekening[$i] ?? null,
                    'atas_nama'   => $request->atas_nama[$i] ?? null,
                ]);
            }
        }

        // ── 6. Anak — hapus lama, isi ulang ─────────────────────────
        $karyawan->anak()->delete();
        foreach ($request->nama_anak ?? [] as $i => $nama) {
            if (!empty($nama)) {
                $karyawan->anak()->create([
                    'nama'          => $nama,
                    'tempat_lahir'  => $request->tempat_lahir_anak[$i] ?? null,
                    'tanggal_lahir' => $request->tanggal_lahir_anak[$i] ?: null,
                    'pekerjaan'     => $request->pekerjaan_anak[$i] ?? null,
                    'jenis_kelamin' => $request->jenis_kelamin_anak[$i] ?? null,
                    'pendidikan'    => $request->pendidikan_anak[$i] ?? null,
                ]);
            }
        }

        return redirect()->route('karyawan')
            ->with('success', 'Data Berhasil Di Edit');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan')
            ->with('success', 'Data Berhasil Di Hapus');
    }

    public function detail($id)
    {
        $data = [
            'title'                  => 'Detail Karyawan',
            'menuSuperadminKaryawan' => 'active',
            'karyawan'               => Karyawan::with(['divisi','jabatan','pribadi','bank','pendidikan','keluarga','anak'])->findOrFail($id),
        ];

        return view('superadmin.karyawan.detail', $data);
    }

    // Export template kosong (untuk import)
    public function export()
    {
        return Excel::download(new KaryawanExport, 'data-karyawan.xlsx');
    }

    // Export data karyawan yang sudah ada
    public function exportData()
    {
        return Excel::download(new KaryawanExportData, 'data-karyawan-export.xlsx');
    }

    public function importForm()
    {
        $data = [
            'title'                  => 'Import Data Karyawan',
            'menuSuperadminKaryawan' => 'active',
        ];

        return view('superadmin.karyawan.import', $data);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file     = $request->file('file');
        $fileName = $file->getClientOriginalName();

        // Validasi 1: Nama file harus diawali "data-karyawan"
        if (!str_starts_with($fileName, 'data-karyawan')) {
            return back()->withErrors([
                'file' => 'File yang diupload harus menggunakan template resmi (data-karyawan.xlsx). Silakan download template terlebih dahulu.'
            ]);
        }

        // Validasi 2: Cek header Excel
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
        $sheet       = $spreadsheet->getActiveSheet();
        $headerRow   = $sheet->rangeToArray('A1:I1')[0];

        $headersFromFile = array_map(fn($h) => strtolower(trim($h)), $headerRow);

        $expectedHeaders = [
            'nama', 'email', 'nik', 'jenis kelamin',
            'tanggal lahir', 'no hp', 'alamat', 'jabatan', 'divisi'
        ];

        if ($headersFromFile !== $expectedHeaders) {
            return back()->withErrors([
                'file' => 'Header kolom tidak sesuai template. Pastikan Anda menggunakan file template resmi yang telah didownload dan tidak mengubah baris header.'
            ]);
        }

        // Validasi 3: Cek ada data minimal 1 baris
        $totalRows = $sheet->getHighestDataRow();
        if ($totalRows < 2) {
            return back()->withErrors([
                'file' => 'File tidak memiliki data. Silakan isi data karyawan terlebih dahulu di baris ke-2 dan seterusnya.'
            ]);
        }

        Excel::import(new KaryawanImport, $file);

        return redirect()->route('karyawan')
            ->with('success', 'Data berhasil diimport');
    }
}