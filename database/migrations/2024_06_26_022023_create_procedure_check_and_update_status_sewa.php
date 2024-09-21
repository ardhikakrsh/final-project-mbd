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
        DB::unprepared('DROP PROCEDURE IF EXISTS check_and_update_sewa_status');

        DB::unprepared('
            CREATE PROCEDURE `check_and_update_sewa_status`(IN sewa_id INT)
            BEGIN
                DECLARE status_sewa ENUM("ditolak", "diterima", "selesai", "menunggu");
                DECLARE status_pembayaran ENUM("menunggu", "ditolak", "diterima", "revisi");

                -- Mengambil status sewa dari tabel sewa
                SELECT sewa.status_sewa INTO status_sewa
                FROM sewa
                WHERE sewa.id = sewa_id;

                -- Mengambil status pembayaran dari tabel pembayaran
                SELECT pembayaran.status_pembayaran INTO status_pembayaran
                FROM pembayaran
                JOIN sewa ON pembayaran.sewa_id = sewa.id
                WHERE sewa.id = sewa_id;

                -- Atur status_sewa berdasarkan kondisi
                IF status_pembayaran = "diterima" AND status_sewa = "menunggu" THEN
                    SET status_sewa = "diterima";
                ELSEIF status_pembayaran = "ditolak" AND status_sewa = "menunggu" THEN
                    SET status_sewa = "ditolak";
                ELSEIF status_pembayaran = "menunggu" AND status_sewa = "menunggu" THEN
                    SET status_sewa = "menunggu";
                ELSEIF status_pembayaran = "revisi" AND status_sewa = "menunggu" THEN
                    SET status_sewa = "menunggu";
                ELSE    
                    SET status_sewa = "selesai";
                END IF;

                -- Update status sewa
                UPDATE sewa
                SET status_sewa = status_sewa
                WHERE id = sewa_id;

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS check_and_update_sewa_status');
    }
};
