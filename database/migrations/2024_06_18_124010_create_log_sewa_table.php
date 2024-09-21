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
        Schema::create('log_sewa', function (Blueprint $table) {
            $table->timestamp('created_at')->useCurrent();
            $table->id();
            $table->unsignedBigInteger('sewa_id');
            $table->string('nama_pelanggan');
            $table->integer('durasi_sewa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_sewa');
    }
};
