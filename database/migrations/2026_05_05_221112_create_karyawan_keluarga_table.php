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
        Schema::connection('db_induk')->create('karyawan_keluarga', function (Blueprint $table) {
    $table->id();

    $table->foreignId('karyawan_id')->constrained('karyawans')->cascadeOnDelete();

    // ORANG TUA
    $table->string('nama_ayah')->nullable();
    $table->string('nama_ibu')->nullable();

    // PASANGAN
    $table->string('nama_pasangan')->nullable();
    $table->string('tempat_lahir_pasangan')->nullable();
    $table->date('tanggal_lahir_pasangan')->nullable();
    $table->string('pekerjaan_pasangan')->nullable();
    $table->string('jenis_kelamin_pasangan')->nullable();
    $table->string('pendidikan_pasangan')->nullable();

    $table->string('jaminan_kesehatan')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_keluarga');
    }
};
