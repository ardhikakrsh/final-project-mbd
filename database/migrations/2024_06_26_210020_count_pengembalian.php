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
        DB::unprepared('DROP FUNCTION IF EXISTS countPengembalian');

        DB::unprepared('
            CREATE FUNCTION countPengembalian() RETURNS JSON
                DETERMINISTIC
            BEGIN
                DECLARE totalPengembalian INT;
                DECLARE totalDenda INT;

                SET totalPengembalian = (
                    SELECT COUNT(*)
                    FROM pengembalian
                );

                SET totalDenda = (
                    SELECT SUM(denda)
                    FROM pengembalian
                );

                RETURN JSON_OBJECT(
                    "totalPengembalian", totalPengembalian,
                    "totalDenda", totalDenda
                );

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS countPengembalian');
    }
};
