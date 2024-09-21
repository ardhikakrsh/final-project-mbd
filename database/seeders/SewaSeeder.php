<?php

namespace Database\Seeders;

use App\Enums\StatusSewaType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sewa')->insert([
            [
                'id' => 1,
                'tanggal_sewa' => '2024-01-28',
                'tanggal_pengembalian' => '2024-01-29',
                'total_harga' => 75000,
                'status_sewa' => StatusSewaType::SELESAI,
                'pesan_penolakan' => NULL,
                'kendaraan_id' => 1,
                'pelanggan_id' => 1,
            ],
            [
                'id' => 2,
                'tanggal_sewa' => '2024-02-04',
                'tanggal_pengembalian' => '2024-02-08',
                'total_harga' => 400000,
                'status_sewa' => StatusSewaType::SELESAI,
                'pesan_penolakan' => NULL,
                'kendaraan_id' => 6,
                'pelanggan_id' => 2,
            ],
            [
                'id' => 3,
                'tanggal_sewa' => '2024-02-16',
                'tanggal_pengembalian' => '2024-02-18',
                'total_harga' => 220000,
                'status_sewa' => StatusSewaType::SELESAI,
                'pesan_penolakan' => NULL,
                'kendaraan_id' => 7,
                'pelanggan_id' => 2,
            ],
            [
                'id' => 4,
                'tanggal_sewa' => '2024-03-20',
                'tanggal_pengembalian' => '2024-03-27',
                'total_harga' => 1960000,
                'status_sewa' => StatusSewaType::SELESAI,
                'pesan_penolakan' => NULL,
                'kendaraan_id' => 8,
                'pelanggan_id' => 3,
            ],
            [
                'id' => 5,
                'tanggal_sewa' => '2024-04-10',
                'tanggal_pengembalian' => '2024-04-14',
                'total_harga' => 3200000,
                'status_sewa' => StatusSewaType::SELESAI,
                'pesan_penolakan' => NULL,
                'kendaraan_id' => 30,
                'pelanggan_id' => 1,
            ],
            [
                'id' => 6,
                'tanggal_sewa' => '2024-04-29',
                'tanggal_pengembalian' => '2024-04-30',
                'total_harga' => 80000,
                'status_sewa' => StatusSewaType::DITOLAK,
                'pesan_penolakan' => 'Salah transfer saat pembayaran',
                'kendaraan_id' => 2,
                'pelanggan_id' => 3,
            ],
            [
                'id' => 7,
                'tanggal_sewa' => '2024-04-29',
                'tanggal_pengembalian' => '2024-05-01',
                'total_harga' => 90000,
                'status_sewa' => StatusSewaType::DITERIMA,
                'pesan_penolakan' => NULL,
                'kendaraan_id' => 3,
                'pelanggan_id' => 2,
            ],
            [
                'id' => 8,
                'tanggal_sewa' => '2024-06-01',
                'tanggal_pengembalian' => '2024-06-04',
                'total_harga' => 660000,
                'status_sewa' => StatusSewaType::MENUNGGU,
                'pesan_penolakan' => NULL,
                'kendaraan_id' => 21,
                'pelanggan_id' => 1,
            ],
        ]);
    }
}
