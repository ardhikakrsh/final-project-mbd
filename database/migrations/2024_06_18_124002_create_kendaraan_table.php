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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto');
            $table->string('merk');
            $table->string('plat', 11);
            $table->string('warna');
            $table->string('kondisi');
            $table->integer('harga');
            $table->unsignedBigInteger('tipe_kendaraan_id');
            $table->unsignedBigInteger('pemilik_id');
            $table->timestamps();

            $table->foreign('tipe_kendaraan_id')->references('id')->on('tipe_kendaraan');
            $table->foreign('pemilik_id')->references('id')->on('pemilik');
            $table->index('pemilik_id', 'idx_kendaraan_pemilik');
            $table->index('harga', 'idx_harga_kendaraan');
            $table->index('tipe_kendaraan_id', 'idx_kendaraan_tipe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
