<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipe_kendaraan')->insert([
            ['id' => 1, 'nama' => 'Motor'],
            ['id' => 2, 'nama' => 'Mobil'],
            ['id' => 3, 'nama' => 'Bus'],
        ]);
    }
}
