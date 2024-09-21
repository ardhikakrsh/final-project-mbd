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
        DB::unprepared('DROP PROCEDURE IF EXISTS getTotalRevenue');

        DB::unprepared('
            CREATE PROCEDURE `getTotalRevenue`(OUT totalRevenue INT)
            BEGIN
                DECLARE sewaRevenue INT DEFAULT 0;
                DECLARE pengembalianRevenue INT DEFAULT 0;

                SELECT sum(total_harga) INTO sewaRevenue 
                    FROM sewa;

                SELECT sum(denda) INTO pengembalianRevenue 
                    FROM pengembalian;
                
                SET totalRevenue = IFNULL(sewaRevenue, 0) + IFNULL(pengembalianRevenue, 0);

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS getTotalRevenue');
    }
};
