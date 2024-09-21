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
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->integer('bintang');
            $table->text('pesan_review');
            $table->unsignedBigInteger('kendaraan_id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->timestamps();

            $table->foreign('kendaraan_id')->references('id')->on('kendaraan');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan');
            $table->index('kendaraan_id', 'review_kendaraan');
            $table->index('pelanggan_id', 'review_pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
