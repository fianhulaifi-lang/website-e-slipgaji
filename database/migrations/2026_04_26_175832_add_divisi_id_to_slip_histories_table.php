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
      Schema::table('slip_histories', function (Blueprint $table) {
    $table->unsignedBigInteger('divisi_id')->nullable()->after('email');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slip_histories', function (Blueprint $table) {
            //
        });
    }
};
