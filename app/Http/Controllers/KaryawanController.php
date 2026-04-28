<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Exports\KaryawanExport;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
 public function index(Request $request)
{
    $query = Karyawan::with('divisi', 'jabatan');

    // FILTER DIVISI (SERVER SIDE)
    if ($request->divisi) {
        $query->where('divisi_id', $request->divisi);
    }

    $data = array(
        'title'                  => 'Data Karyawan',
        'menuSuperadminKaryawan' => 'active',
        'karyawan'               => $query->orderBy('nama', 'asc')->get(),
        'divisi'                 => Divisi::orderBy('nama_divisi', 'asc')->get(), // penting untuk dropdown
        'jabatan'               => Jabatan::all(),
    );

    return view('superadmin.karyawan.index', $data);
}

   public function create()
{
    $data = array(
        'title' => 'Tambah Data Karyawan',
        'menuSuperadminKaryawan' => 'active',
        'divisi' => Divisi::all(),
        'jabatan' => Jabatan::all(),
    );

    return view('superadmin.karyawan.create', $data);
}

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required',
            'email'      => 'required|unique:db_induk.karyawans,email',
            'nik'        => 'required|unique:db_induk.karyawans,nik',
            'no_hp'      => 'required',
            'alamat'     => 'required',
            'jabatan_id' => 'required',
            'divisi_id'  => 'required',
        ]);

        $karyawan = new Karyawan;
        $karyawan->nama       = $request->nama;
        $karyawan->email      = $request->email;
        $karyawan->nik        = $request->nik;
        $karyawan->no_hp      = $request->no_hp;
        $karyawan->alamat     = $request->alamat;
        $karyawan->jabatan_id = $request->jabatan_id;
        $karyawan->divisi_id  = $request->divisi_id;
        $karyawan->save();

        return redirect()->route('karyawan')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

   public function edit($id)
{
    $data = array(
        'title' => 'Edit Data Karyawan',
        'menuSuperadminKaryawan' => 'active',
        'karyawan' => Karyawan::findOrFail($id),
        'divisi' => Divisi::all(),
        'jabatan' => Jabatan::all(),
    );

    return view('superadmin.karyawan.edit', $data);
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'       => 'required',
            'email'      => 'required|unique:db_induk.karyawans,email,' . $id,
            'nik'        => 'required|unique:db_induk.karyawans,nik,' . $id,
            'no_hp'      => 'required',
            'alamat'     => 'required',
            'jabatan_id' => 'required',
            'divisi_id'  => 'required',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->nama       = $request->nama;
        $karyawan->email      = $request->email;
        $karyawan->nik        = $request->nik;
        $karyawan->no_hp      = $request->no_hp;
        $karyawan->alamat     = $request->alamat;
        $karyawan->jabatan_id = $request->jabatan_id;
        $karyawan->divisi_id  = $request->divisi_id;
        $karyawan->save();

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
    public function exportExcel()
{
    return Excel::download(new KaryawanExport, 'data-karyawan.xlsx');
}
    
}