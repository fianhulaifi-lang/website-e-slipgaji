<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\SlipHistory;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'totalUser' => User::count(),
            'totalKaryawan' => Karyawan::count(),
            'totalRiwayat' => SlipHistory::count()
        ];

        if (auth()->user()->role == 'superadmin') {
        return view('superadmin.dashboard', $data);
        }

        return view('admin.dashboard', $data);
    }
}