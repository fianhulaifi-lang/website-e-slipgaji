<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Divisi',
            'divisi' => Divisi::orderBy('nama_divisi', 'asc')->get(),
        ];

        return view('superadmin.divisi.index', $data);
    }

    public function create()
    {
        return view('superadmin.divisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required'
        ]);

        Divisi::create([
            'nama_divisi' => $request->nama_divisi
        ]);

        return redirect()->route('divisi')->with('success', 'Divisi berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('superadmin.divisi.edit', [
            'divisi' => Divisi::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $divisi = Divisi::findOrFail($id);

        $divisi->update([
            'nama_divisi' => $request->nama_divisi
        ]);

        return redirect()->route('divisi')->with('success', 'Divisi berhasil diupdate');
    }

    public function destroy($id)
    {
        Divisi::findOrFail($id)->delete();

        return redirect()->route('divisi')->with('success', 'Divisi berhasil dihapus');
    }
}
