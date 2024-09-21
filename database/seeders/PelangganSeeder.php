<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggan')->insert([
            [
                'id' => 1,
                'NIK' => '3174091811030004',
                'nomor_telepon' => '083879776551',
                'alamat' => 'Jl. Keputih Makam Blok. B',
                'users_id' => 2,
            ],
            [
                'id' => 2,
                'NIK' => '3515086605040002',
                'nomor_telepon' => '08813472955',
                'alamat' => 'Jl. Teknik Komputer II',
                'users_id' => 3,
            ],
            [
                'id' => 3,
                'NIK' => '3578022503040003',
                'nomor_telepon' => '081935116638',
                'alamat' => 'Purimas Kuta Paradise G8-1',
                'users_id' => 4,
            ],
        ]);
    }
}
