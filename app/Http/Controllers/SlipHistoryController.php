<?php

namespace App\Http\Controllers;

use App\Models\SlipHistory;

class SlipHistoryController extends Controller
{
    public function index()
    {
        $data = SlipHistory::latest()->get();

        return view('superadmin.slip.history',[
            'title' => 'Riwayat Slip Gaji',
            'data' => $data
        ]);
    }
}
