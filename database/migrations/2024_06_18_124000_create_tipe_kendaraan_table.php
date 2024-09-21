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
        Schema::create('tipe_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
            $table->index('nama', 'idx_nama_tipe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_kendaraan');
    }
};
