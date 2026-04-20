<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'totalUser' => User::count(),
            'totalKaryawan' => Karyawan::count()
        ];

        return view('dashboard', $data);
    }
}
