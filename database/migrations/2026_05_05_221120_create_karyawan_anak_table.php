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
        Schema::connection('db_induk')->create('karyawan_anak', function (Blueprint $table) {
    $table->id();

    $table->foreignId('karyawan_id')->constrained('karyawans')->cascadeOnDelete();

    $table->string('nama')->nullable();
    $table->string('tempat_lahir')->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('pekerjaan')->nullable();
    $table->string('jenis_kelamin')->nullable();
    $table->string('pendidikan')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_anak');
    }
};
