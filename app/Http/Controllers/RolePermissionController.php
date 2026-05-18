<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public static array $features = [
        'divisi' => [
            'label'   => 'Kelola Divisi',
            'actions' => ['edit', 'hapus'],
        ],
        'jabatan' => [
            'label'   => 'Kelola Jabatan',
            'actions' => ['edit', 'hapus'],
        ],
        'karyawan' => [
            'label'   => 'Kelola Karyawan',
            'actions' => ['view', 'edit', 'hapus'],
        ],
        'slip' => [
            'label'   => 'Kirim Slip Gaji',
             'actions' => ['akses'],
        ],
        'slipHistory' => [
            'label'   => 'Detail Riwayat',
             'actions' => ['akses'],
        ],
        'setting' => [
            'label'   => 'Setting',
            'actions' => ['akses'],
        ],
    ];

    public function index()
    {
        $permissions = RolePermission::where('role', 'admin')
                                     ->get()
                                     ->keyBy('permission');

        return view('role.index', compact('permissions'));
    }

    public function toggle(Request $request)
    {
        $request->validate(['permission' => 'required|string']);

        $record = RolePermission::firstOrCreate(
            ['role' => 'admin', 'permission' => $request->permission],
            ['is_active' => true]
        );

        $record->update(['is_active' => !$record->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $record->is_active,
        ]);
    }
}