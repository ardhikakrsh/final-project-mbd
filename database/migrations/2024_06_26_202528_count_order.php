<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS countOrder');

        DB::unprepared('
            CREATE FUNCTION countOrder() RETURNS JSON
                DETERMINISTIC
            BEGIN
                DECLARE totalOrder INT;
                DECLARE totalSelesai INT;

                SET totalOrder = (
                    SELECT COUNT(*)
                    FROM sewa
                );

                SET totalSelesai = (
                    SELECT COUNT(*)
                    FROM sewa
                    WHERE status_sewa = "selesai"
                );

                RETURN JSON_OBJECT(
                    "totalOrder", totalOrder,
                    "totalSelesai", totalSelesai
                );

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS countOrder');
    }
};
