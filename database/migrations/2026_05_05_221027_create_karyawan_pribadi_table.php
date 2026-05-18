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
      Schema::connection('db_induk')->create('karyawan_pribadi', function (Blueprint $table) {
    $table->id();

    $table->foreignId('karyawan_id')->constrained('karyawans')->cascadeOnDelete();


    $table->string('agama')->nullable();
    $table->string('suku')->nullable();
    $table->string('tempat_lahir')->nullable();
    $table->string('status_nikah')->nullable();
    $table->string('hobby')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_pribadi');
    }
};
