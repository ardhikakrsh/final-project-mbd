<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengembalianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengembalian')->insert([
            [
                'id' => 1,
                'kondisi' => 'Baik',
                'tanggal_pengembalian' => '2024-01-29',
                'masalah' => 0,
                'denda' => NULL,
                'sewa_id' => 1,
            ],
            [
                'id' => 2,
                'kondisi' => 'Cukup Baik',
                'tanggal_pengembalian' => '2024-02-08',
                'masalah' => 0,
                'denda' => NULL,
                'sewa_id' => 2,
            ],
            [
                'id' => 3,
                'kondisi' => 'Sangat Baik',
                'tanggal_pengembalian' => '2024-02-18',
                'masalah' => 0,
                'denda' => NULL,
                'sewa_id' => 3,
            ],
            [
                'id' => 4,
                'kondisi' => 'Sangat Baik',
                'tanggal_pengembalian' => '2024-03-27',
                'masalah' => 0,
                'denda' => NULL,
                'sewa_id' => 4,
            ],
            [
                'id' => 5,
                'kondisi' => 'Sangat Baik',
                'tanggal_pengembalian' => '2024-04-14',
                'masalah' => 0,
                'denda' => NULL,
                'sewa_id' => 5,
            ],
        ]);
    }
}
