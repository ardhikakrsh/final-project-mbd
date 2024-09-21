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
        DB::unprepared('DROP FUNCTION IF EXISTS cekDurasi');

        DB::unprepared('
            CREATE FUNCTION cekDurasi (id INT) RETURNS INT
                DETERMINISTIC
            BEGIN
                DECLARE DurasiSewa INT;
                SET DurasiSewa = (
                    SELECT DATEDIFF(tanggal_pengembalian, tanggal_sewa)
                    FROM sewa
                    WHERE id = sewa.id
                );
                RETURN DurasiSewa;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS cekDurasi');
    }
};
