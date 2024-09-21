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
        DB::unprepared('DROP PROCEDURE IF EXISTS `update_status_pembayaran`');

        DB::unprepared('
        CREATE PROCEDURE `update_status_pembayaran`(IN pembayaran_id INT)
        BEGIN
            DECLARE status_pembayaran ENUM("menunggu", "ditolak", "diterima", "revisi");
            DECLARE jumlah_pembayaran INT;
            DECLARE total_harga INT;
            DECLARE detail_pembayaran ENUM("lunas", "dp", "denda");

            -- Mengambil nilai total harga berdasarkan id sewa
            SELECT sewa.total_harga INTO total_harga
            FROM sewa
            JOIN pembayaran ON pembayaran.sewa_id = sewa.id
            WHERE pembayaran.id = pembayaran_id;

            -- Mengambil nilai jumlah pembayaran dan detail_pembayaran dari tabel pembayaran
            SELECT pembayaran.jumlah_pembayaran, pembayaran.detail_pembayaran INTO jumlah_pembayaran, detail_pembayaran
            FROM pembayaran
            WHERE pembayaran.id = pembayaran_id;

            -- Atur status_pembayaran berdasarkan kondisi
            IF jumlah_pembayaran = total_harga AND detail_pembayaran = "lunas" THEN
                SET status_pembayaran = "diterima";
            ELSEIF jumlah_pembayaran < total_harga AND detail_pembayaran = "dp" THEN
                SET status_pembayaran = "diterima";
            ELSEIF jumlah_pembayaran > total_harga THEN
                SET status_pembayaran = "revisi";
            ELSE
                SET status_pembayaran = "ditolak";
            END IF;

            -- Update status pembayaran
            UPDATE pembayaran
            SET status_pembayaran = status_pembayaran
            WHERE id = pembayaran_id;

        END

    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `update_status_pembayaran`');
    }
};
