<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('db_induk')->create('karyawans', function (Blueprint $table) {
    $table->id();

    // IDENTITAS
    $table->string('nik')->unique();
    $table->string('no_absen')->nullable();
    $table->string('nama');
    $table->string('nama_panggilan')->nullable();
    $table->string('email')->nullable();
    $table->string('no_hp')->nullable();
    $table->string('no_ktp')->unique();

    // RELASI
    $table->foreignId('jabatan_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('divisi_id')->nullable()->constrained()->nullOnDelete();

    // STATUS KARYAWAN
    $table->string('status_pegawai')->nullable(); // tetap / kontrak
    $table->string('status_aktif')->nullable();   // aktif / nonaktif
    $table->string('golongan')->nullable();

    // TANGGAL
    $table->date('tanggal_masuk')->nullable();
    $table->date('tanggal_pengangkatan')->nullable();
    $table->date('tanggal_pensiun')->nullable();

    // MASA KERJA & CUTI
    $table->integer('masa_kerja')->nullable();
    $table->integer('jatah_cuti')->nullable();
    $table->integer('sisa_cuti')->nullable();

    // TAMBAHAN (yang tadi sempat error duplicate)
    $table->string('jenis_kelamin')->nullable();
    $table->date('tanggal_lahir')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
