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
        DB::unprepared('DROP FUNCTION IF EXISTS countPembayaran');

        DB::unprepared('
            CREATE FUNCTION countPembayaran() RETURNS JSON
                DETERMINISTIC
            BEGIN
                DECLARE totalPembayaran INT;
                DECLARE totalHargaBayar INT;

                SET totalPembayaran = (
                    SELECT COUNT(*)
                    FROM pembayaran
                );

                set totalHargaBayar = (
                    SELECT SUM(jumlah_pembayaran)
                    FROM pembayaran
                );

                RETURN JSON_OBJECT(
                    "totalPembayaran", totalPembayaran,
                    "totalHargaBayar", totalHargaBayar
                );

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS countPembayaran');
    }
};
