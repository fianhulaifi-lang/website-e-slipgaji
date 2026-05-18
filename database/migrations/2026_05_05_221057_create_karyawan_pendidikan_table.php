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
        Schema::connection('db_induk')->create('karyawan_pendidikan', function (Blueprint $table) {
    $table->id();

    $table->foreignId('karyawan_id')->constrained('karyawans')->cascadeOnDelete();

    $table->string('sd')->nullable();
    $table->string('sltp')->nullable();
    $table->string('slta')->nullable();
    $table->string('pt')->nullable();

    $table->string('pendidikan_terakhir')->nullable();
    $table->string('jurusan')->nullable();
    $table->string('tahun_masuk')->nullable();
    $table->string('tahun_keluar')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_pendidikan');
    }
};
