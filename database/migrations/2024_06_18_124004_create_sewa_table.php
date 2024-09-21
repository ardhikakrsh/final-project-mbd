<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusSewaType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sewa', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_sewa');
            $table->date('tanggal_pengembalian');
            $table->integer('total_harga');
            $table->enum('status_sewa', StatusSewaType::getStatuses())->default(StatusSewaType::MENUNGGU);
            $table->text('pesan_penolakan')->nullable();
            $table->unsignedBigInteger('kendaraan_id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->timestamps();

            $table->foreign('kendaraan_id')->references('id')->on('kendaraan');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan');
            $table->index('kendaraan_id', 'sewa_kendaraan');
            $table->index('pelanggan_id', 'idx_pelanggan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewa');
    }
};
