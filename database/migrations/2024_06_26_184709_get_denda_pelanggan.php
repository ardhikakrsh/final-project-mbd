<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS getDendaPelanggan');

        DB::unprepared('
            CREATE FUNCTION getDendaPelanggan(INpelanggan_id INT) RETURNS int
            BEGIN
                DECLARE totalDenda INT;
                SELECT SUM(pengembalian.denda) INTO totalDenda
                    FROM pengembalian
                        JOIN sewa ON sewa.id = pengembalian.sewa_id
                        WHERE sewa.pelanggan_id = INpelanggan_id;

                return totalDenda;
            END;
        ');    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS getDendaPelanggan');
    }
};
