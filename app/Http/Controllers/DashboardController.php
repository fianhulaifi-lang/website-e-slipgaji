<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\SlipHistory;
use App\Models\Divisi;
use App\Models\Jabatan;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'totalUser' => User::count(),
            'totalKaryawan' => Karyawan::count(),
            'totalRiwayat' => SlipHistory::count(),
            'totalDivisi' => Divisi::count(),
            'totalJabatan' => Jabatan::count(),
        ];

        if (auth()->user()->role == 'superadmin') {
        return view('superadmin.dashboard', $data);
        }

        return view('admin.dashboard', $data);
    }
}