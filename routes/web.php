<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('login',[AuthController::class,'login'])->name ('login');
Route::post('login',[AuthController::class,'loginProses'])->name ('loginProses');
Route::get('logout',[AuthController::class,'logout'])->name ('logout');
Route::middleware('checkLogin')->group(function(){
    //dashboard
     Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
     //user
     Route::get('user',[UserController::class,'index'])->name ('user');  
     Route::get('user/create',[UserController::class,'create'])->name ('userCreate');
     Route::post('user/store',[UserController::class,'store'])->name ('userStore');  
      Route::get('user/edit/{id}',[UserController::class,'edit'])->name ('userEdit');
      Route::post('user/update/{id}',[UserController::class,'update'])->name ('userUpdate');
      Route::delete('user/destroy/{id}',[UserController::class,'destroy'])->name ('userDestroy');
     //daftar karyawan
     Route::get('karyawan',[KaryawanController::class,'index'])->name ('karyawan'); 
     Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawanCreate');
    Route::post('karyawan/store', [KaryawanController::class, 'store'])->name('karyawanStore');
    Route::get('karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawanEdit');
    Route::post('karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawanUpdate');
    Route::delete('karyawan/destroy/{id}', [KaryawanController::class, 'destroy'])->name('karyawanDestroy');

});

