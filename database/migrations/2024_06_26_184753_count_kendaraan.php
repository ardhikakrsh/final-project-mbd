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
        DB::unprepared('DROP FUNCTION IF EXISTS countKendaraan');

        DB::unprepared('
            CREATE FUNCTION countKendaraan() RETURNS JSON
                DETERMINISTIC
            BEGIN
                DECLARE totalKendaraan INT;
                DECLARE totalMotor INT;
                DECLARE totalMobil INT;
                DECLARE totalBus INT;

                SET totalKendaraan = (
                    SELECT COUNT(*)
                    FROM kendaraan
                );

                SET totalMotor = (
                    SELECT COUNT(*)
                    FROM kendaraan
                    JOIN tipe_kendaraan ON kendaraan.tipe_kendaraan_id = tipe_kendaraan.id
                    WHERE tipe_kendaraan.nama = "motor"
                );

                SET totalMobil = (
                    SELECT COUNT(*)
                    FROM kendaraan
                    JOIN tipe_kendaraan ON kendaraan.tipe_kendaraan_id = tipe_kendaraan.id
                    WHERE tipe_kendaraan.nama = "mobil"
                );

                SET totalBus = (
                    SELECT COUNT(*)
                    FROM kendaraan
                    JOIN tipe_kendaraan ON kendaraan.tipe_kendaraan_id = tipe_kendaraan.id
                    WHERE tipe_kendaraan.nama = "bus"
                );

                RETURN JSON_OBJECT(
                    "totalKendaraan", totalKendaraan,
                    "totalMotor", totalMotor,
                    "totalMobil", totalMobil,
                    "totalBus", totalBus
                );

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS countKendaraan');
    }
};
