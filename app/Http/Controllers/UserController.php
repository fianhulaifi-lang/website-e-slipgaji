<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data User',
            'menuSuperadmindminUser' => 'active',
            'user' => User::orderBy('role', 'asc')->get(),
        );

        return view('superadmin.user.index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Tambah Data User',
            'menuSuperadminUser' => 'active',
            'divisi' => Divisi::all()
        );

        return view('superadmin.user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'role' => 'required',
            'divisi_id' => 'required_unless:role,Superadmin',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->divisi_id = $request->divisi_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Data User',
            'menuSuperadminUser' => 'active',
            'user' => User::findOrFail($id),
            'divisi' => Divisi::all()
        );

        return view('superadmin.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'role' => 'required',
            'divisi_id' => 'required_unless:role,Superadmin',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->divisi_id = $request->divisi_id;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user')
            ->with('success', 'Data Berhasil Di Edit');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')
            ->with('success', 'Data Berhasil Di Hapus');
    }
}