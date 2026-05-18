<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SlipController;
use App\Http\Controllers\SlipHistoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProses'])->name('loginProses');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['checkLogin'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // SUPERADMIN ONLY
    Route::middleware('role:superadmin')->group(function () {
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::get('user/create', [UserController::class, 'create'])->name('userCreate');
        Route::post('user/store', [UserController::class, 'store'])->name('userStore');
        Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
        Route::post('user/update/{id}', [UserController::class, 'update'])->name('userUpdate');
        Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('userDestroy');

        // ROLE MANAGEMENT ← tambahan baru
        Route::get('role-management', [RolePermissionController::class, 'index'])->name('role.index');
        Route::post('role-management/toggle', [RolePermissionController::class, 'toggle'])->name('role.toggle');
    });

    // ADMIN + SUPERADMIN
    Route::middleware('role:admin,superadmin')->group(function () {
        Route::get('/setting', [SettingController::class, 'index'])->name('setting');
        Route::post('/setting', [SettingController::class, 'update'])->name('settingUpdate');

        // DIVISI
        Route::get('divisi', [DivisiController::class, 'index'])->name('divisi');
        Route::get('divisi/create', [DivisiController::class, 'create'])->name('divisiCreate');
        Route::post('divisi/store', [DivisiController::class, 'store'])->name('divisiStore');
        Route::get('divisi/edit/{id}', [DivisiController::class, 'edit'])->name('divisiEdit');
        Route::post('divisi/update/{id}', [DivisiController::class, 'update'])->name('divisiUpdate');
        Route::delete('divisi/destroy/{id}', [DivisiController::class, 'destroy'])->name('divisiDestroy');

        // JABATAN
        Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan');
        Route::post('jabatan/store', [JabatanController::class, 'store'])->name('jabatanStore');
        Route::post('jabatan/update/{id}', [JabatanController::class, 'update'])->name('jabatanUpdate');
        Route::delete('jabatan/destroy/{id}', [JabatanController::class, 'destroy'])->name('jabatanDestroy');

        // KARYAWAN
        Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan');
        Route::get('karyawan/export', [KaryawanController::class, 'export'])->name('karyawanExport');
        Route::get('karyawan/export-data', [KaryawanController::class, 'exportData'])->name('karyawanExportData');
        Route::get('karyawan/import', [KaryawanController::class, 'importForm'])->name('karyawanImportForm');
        Route::post('karyawan/import', [KaryawanController::class, 'import'])->name('karyawanImport');
        Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawanCreate');
        Route::post('karyawan/store', [KaryawanController::class, 'store'])->name('karyawanStore');
        Route::get('karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawanEdit');
        Route::get('karyawan/detail/{id}', [KaryawanController::class, 'detail'])->name('karyawanDetail');
        Route::post('karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawanUpdate');
        Route::delete('karyawan/destroy/{id}', [KaryawanController::class, 'destroy'])->name('karyawanDestroy');

        // SLIP
        Route::get('slip/history', [SlipHistoryController::class, 'index'])->name('slipHistory');
        Route::get('slip/history/export', [SlipHistoryController::class, 'export'])->name('slipHistoryExport');
        Route::delete('slip/history/destroy-bulk', [SlipHistoryController::class, 'destroyBulk'])->name('slipHistoryDestroyBulk');
        Route::get('slip/create', [SlipController::class, 'create'])->name('slipCreate');
        Route::post('slip/upload', [SlipController::class, 'upload'])->name('slipUpload');
        Route::get('slip/preview', [SlipController::class, 'preview'])->name('slipPreview');
        Route::post('slip/store', [SlipController::class, 'store'])->name('slipStore');
        Route::post('slip/store-all', [SlipController::class, 'storeAll'])->name('slipStoreAll');
        Route::post('slip/store-divisi', [SlipController::class, 'storeDivisi'])->name('slipStoreDivisi');
    });

});