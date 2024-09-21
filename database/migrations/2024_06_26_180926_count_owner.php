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
        DB::unprepared('DROP FUNCTION IF EXISTS countOwner');

        // Buat fungsi hitungOwner
        DB::unprepared('
            CREATE FUNCTION countOwner() RETURNS INT
                DETERMINISTIC
            BEGIN
                DECLARE totalOwner INT;
                SET totalOwner = (
                    SELECT COUNT(*)
                    FROM users
                    WHERE role = "owner"
                );
                RETURN totalOwner;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS countOwner');
    }
};
