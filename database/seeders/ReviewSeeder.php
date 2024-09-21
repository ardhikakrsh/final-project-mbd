<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('review')->insert([
            [
                'id' => 1,
                'bintang' => 5,
                'pesan_review' => 'Bus paling enak dan nyaman yang pernah saya sewa!',
                'kendaraan_id' => 30,
                'pelanggan_id' => 1,
            ],
            [
                'id' => 2,
                'bintang' => 3,
                'pesan_review' => 'Mobil brionya sudah waktunya service.',
                'kendaraan_id' => 6,
                'pelanggan_id' => 2,
            ],
            [
                'id' => 3,
                'bintang' => 5,
                'pesan_review' => 'Mobil kencang dan interior seperti baru.',
                'kendaraan_id' => 8,
                'pelanggan_id' => 3,
            ],
            [
                'id' => 4,
                'bintang' => 4,
                'pesan_review' => 'Bagus dan keren saat dipakai night ride.',
                'kendaraan_id' => 1,
                'pelanggan_id' => 1,
            ],
            [
                'id' => 5,
                'bintang' => 1,
                'pesan_review' => 'Kecewa AC tidak dingin.',
                'kendaraan_id' => 7,
                'pelanggan_id' => 2,
            ],
        ]);
    }
}
