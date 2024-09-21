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
        DB::unprepared('DROP FUNCTION IF EXISTS countUser');

        // Buat fungsi hitungUser
        DB::unprepared('
            CREATE FUNCTION countUser() RETURNS INT
                DETERMINISTIC
            BEGIN
                DECLARE totalUser INT;
                SET totalUser = (
                    SELECT COUNT(*)
                    FROM users
                    WHERE role = "user"
                );
                RETURN totalUser;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS countUser');
    }
};
