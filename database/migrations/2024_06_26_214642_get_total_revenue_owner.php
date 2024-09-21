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
        DB::unprepared('DROP PROCEDURE IF EXISTS getTotalRevenueOwner');

        DB::unprepared('
            CREATE PROCEDURE `getTotalRevenueOwner`(IN INid INT, OUT getTotalRevenueOwner INT)
            BEGIN
                DECLARE sewaRevenue INT DEFAULT 0;
                DECLARE pengembalianRevenue INT DEFAULT 0;

                SELECT SUM(total_harga) INTO sewaRevenue
                FROM sewa
                WHERE kendaraan_id IN (SELECT id
                                        FROM kendaraan
                                        WHERE pemilik_id = INid);

                SELECT sum(pengembalian.denda) INTO pengembalianRevenue
                    FROM pengembalian JOIN sewa ON pengembalian.sewa_id = sewa.id
                    WHERE sewa.kendaraan_id in (Select id from kendaraan where pemilik_id = INid);
                
                SET getTotalRevenueOwner = IFNULL(sewaRevenue, 0) + IFNULL(pengembalianRevenue, 0);

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS getTotalRevenueOwner');
    }
};
