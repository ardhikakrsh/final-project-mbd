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
        DB::unprepared('
        CREATE TRIGGER HitungDenda BEFORE INSERT ON pengembalian
        FOR EACH ROW
        BEGIN
            DECLARE denda INT;
            DECLARE pengembalian_seharusnya DATE;
            DECLARE total_harga INT;
            DECLARE harga INT;
            DECLARE id_sewa INT;
            DECLARE durasi INT;

            -- Select the necessary values from the "sewa" table
            SELECT sewa.id, sewa.tanggal_pengembalian, sewa.total_harga 
            INTO id_sewa, pengembalian_seharusnya, total_harga 
            FROM sewa 
            WHERE sewa.id = NEW.sewa_id;

            -- Call the function "cekDurasi" to get the duration
            SET durasi = cekDurasi(id_sewa);

            -- Calculate the per day price
            SET harga = total_harga / durasi;

            -- Calculate the fine (denda)
            SET denda = harga * DATEDIFF(NEW.tanggal_pengembalian, pengembalian_seharusnya);

            -- Set the calculated fine (denda) directly in the NEW row
            SET NEW.denda = denda;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS HitungDenda');
    }
};
