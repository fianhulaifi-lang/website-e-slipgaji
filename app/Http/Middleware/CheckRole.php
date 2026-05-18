<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RolePermission;

class CheckRole
{
    protected array $permMap = [
        // DIVISI
        'divisiCreate'   => 'divisi.edit',
        'divisiStore'    => 'divisi.edit',
        'divisiEdit'     => 'divisi.edit',
        'divisiUpdate'   => 'divisi.edit',
        'divisiDestroy'  => 'divisi.hapus',

        // JABATAN
        'jabatanStore'   => 'jabatan.edit',
        'jabatanUpdate'  => 'jabatan.edit',
        'jabatanDestroy' => 'jabatan.hapus',

        // KARYAWAN
        'karyawan'           => 'karyawan.view',
        'karyawanDetail'     => 'karyawan.view',
        'karyawanExport'     => 'karyawan.view',
        'karyawanExportData' => 'karyawan.view',
        'karyawanImportForm' => 'karyawan.edit',
        'karyawanImport'     => 'karyawan.edit',
        'karyawanCreate'     => 'karyawan.edit',
        'karyawanStore'      => 'karyawan.edit',
        'karyawanEdit'       => 'karyawan.edit',
        'karyawanUpdate'     => 'karyawan.edit',
        'karyawanDestroy'    => 'karyawan.hapus',

        // SLIP
        'slipCreate'      => 'slip.edit',
        'slipUpload'      => 'slip.edit',
        'slipPreview'     => 'slip.view',
        'slipStore'       => 'slip.edit',
        'slipStoreAll'    => 'slip.edit',
        'slipStoreDivisi' => 'slip.edit',

        // RIWAYAT
        'slipHistory'            => 'slipHistory.view',
        'slipHistoryExport'      => 'slipHistory.view',
        'slipHistoryDestroyBulk' => 'slipHistory.hapus',

        // SETTING
        'setting'       => 'setting.akses',
        'settingUpdate' => 'setting.akses',
    ];

    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(Auth::user()->role);
        $allowed  = array_map('strtolower', $roles);

        if (!in_array($userRole, $allowed)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Akses ditolak.'], 403);
            }
            return redirect()->back()->with('error', 'Akses ditolak. Halaman ini hanya untuk: ' . implode(', ', $roles));
        }

        if ($userRole === 'admin') {
            $routeName = $request->route()->getName();

            if (isset($this->permMap[$routeName])) {
                $permKey = $this->permMap[$routeName];

                if (!RolePermission::isAllowed('admin', $permKey)) {
                    if ($request->expectsJson()) {
                        return response()->json(['message' => 'Aksi ini dinonaktifkan oleh Superadmin.'], 403);
                    }
                    return redirect()->back()
                        ->with('error', 'Aksi ini telah dinonaktifkan oleh Superadmin.');
                }
            }
        }

        return $next($request);
    }
}