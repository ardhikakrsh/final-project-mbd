<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemilik')->insert([
            ['id' => 1, 'nomor_telepon' => '081234560001', 'alamat' => 'Jl. Keputih', 'users_id' => 5],
            ['id' => 2, 'nomor_telepon' => '081234560002', 'alamat' => 'Jl. Tenik Kimia', 'users_id' => 6],
            ['id' => 3, 'nomor_telepon' => '081234560003', 'alamat' => 'Jl. Mulyosari', 'users_id' => 7],
        ]);
    }
}
