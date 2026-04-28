<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.min' => 'Password Minimal 8 Karakter',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {

            if (auth()->user()->role == 'superadmin') {
                return redirect()->route('dashboard')
                    ->with('success', 'Login sebagai Superadmin');
            }

            if (auth()->user()->role == 'admin') {
                return redirect()->route('dashboard')
                    ->with('success', 'Login sebagai Admin');
            }

            return redirect()->route('dashboard');
        }

        return redirect()->back()
            ->with('error', 'Email atau Password Salah');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')
            ->with('success', 'Anda Berhasil Logout');
    }
}