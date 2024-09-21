<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusPembayaranType;
use App\Enums\TipePembayaranType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('metode_pembayaran', 15);
            $table->integer('jumlah_pembayaran');
            $table->string('bukti_pembayaran');
            $table->enum('detail_pembayaran', TipePembayaranType::getAll());
            $table->enum('status_pembayaran', StatusPembayaranType::getAll())->default(StatusPembayaranType::MENUNGGU);           
            $table->text('pesan_revisi')->nullable();
            $table->unsignedBigInteger('sewa_id');
            $table->timestamps();

            $table->foreign('sewa_id')->references('id')->on('sewa');
            $table->index('sewa_id', 'pembayaran_sewa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
