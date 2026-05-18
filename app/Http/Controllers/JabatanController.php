<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        return view('superadmin.jabatan.index', [
            'jabatan' => Jabatan::orderBy('nama_jabatan', 'asc')->get(),
            'title' => 'Data Jabatan'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required'
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return back()->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required'
        ]);

        $jabatan = Jabatan::findOrFail($id);

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return back()->with('success', 'Jabatan berhasil diupdate');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return back()->with('success', 'Jabatan berhasil dihapus');
    }
}