<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = array(
            'title'                 => 'Data Karyawan',
            'menuSuperadminKaryawan'=> 'active',
            'karyawan'              => Karyawan::orderBy('nama', 'asc')->get(),
        );

        return view('superadmin.karyawan.index', $data);
    }

    public function create()
    {
        $data = array(
            'title'                 => 'Tambah Data Karyawan',
            'menuSuperadminKaryawan'=> 'active',
        );

        return view('superadmin.karyawan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|unique:karyawans,email',
            'no_kode'  => 'required|unique:karyawans,no_kode',
        ],[
            'nama.required'        => 'Nama Tidak Boleh Kosong',
            'email.required'       => 'Email Tidak Boleh Kosong',
            'email.unique'         => 'Email Sudah Ada',
            'no_kode.required'     => 'No Kode Tidak Boleh Kosong',
            'no_kode.unique'       => 'No Kode Sudah Ada',
        ]);

        $karyawan = new Karyawan;
        $karyawan->nama    = $request->nama;
        $karyawan->email   = $request->email;
        $karyawan->no_kode = $request->no_kode;
        $karyawan->save();

        return redirect()->route('karyawan')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = array(
            'title'                 => 'Edit Data Karyawan',
            'menuSuperadminKaryawan'=> 'active',
            'karyawan'              => Karyawan::findOrFail($id),
        );

        return view('superadmin.karyawan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|unique:karyawans,email,' . $id,
            'no_kode'  => 'required|unique:karyawans,no_kode,' . $id,
        ],[
            'nama.required'        => 'Nama Tidak Boleh Kosong',
            'email.required'       => 'Email Tidak Boleh Kosong',
            'email.unique'         => 'Email Sudah Ada',
            'no_kode.required'     => 'No Kode Tidak Boleh Kosong',
            'no_kode.unique'       => 'No Kode Sudah Ada',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->nama    = $request->nama;
        $karyawan->email   = $request->email;
        $karyawan->no_kode = $request->no_kode;
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
}
