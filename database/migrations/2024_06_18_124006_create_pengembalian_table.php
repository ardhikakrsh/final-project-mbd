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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->string('kondisi');
            $table->date('tanggal_pengembalian');
            $table->boolean('masalah');
            $table->integer('denda')->nullable();
            $table->unsignedBigInteger('sewa_id');
            $table->timestamps();

            $table->foreign('sewa_id')->references('id')->on('sewa');
            $table->index('sewa_id', 'pengembalian_sewa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
