<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembayaran')->insert([
            [
                'id' => 1,
                'metode_pembayaran' => 'BCA',
                'jumlah_pembayaran' => 75000,
                'bukti_pembayaran' => 'bukti_1.jpeg',
                'detail_pembayaran' => 'lunas',
                'status_pembayaran' => 'diterima',
                'pesan_revisi' => NULL,
                'sewa_id' => 1,
            ],
            [
                'id' => 2,
                'metode_pembayaran' => 'MANDIRI',
                'jumlah_pembayaran' => 200000,
                'bukti_pembayaran' => 'bukti_2.jpeg',
                'detail_pembayaran' => 'dp',
                'status_pembayaran' => 'diterima',
                'pesan_revisi' => NULL,
                'sewa_id' => 2
            ],
            [
                'id' => 3,
                'metode_pembayaran' => 'MANDIRI',
                'jumlah_pembayaran' => 220000,
                'bukti_pembayaran' => 'bukti_3.jpeg',
                'detail_pembayaran' => 'lunas',
                'status_pembayaran' => 'diterima',
                'pesan_revisi' => NULL,
                'sewa_id' => 3
            ],
            [
                'id' => 4,
                'metode_pembayaran' => 'Cash',
                'jumlah_pembayaran' => 1960000,
                'bukti_pembayaran' => 'bukti_4.jpeg',
                'detail_pembayaran' => 'lunas',
                'status_pembayaran' => 'diterima',
                'pesan_revisi' => NULL,
                'sewa_id' => 4
            ],
            [
                'id' => 5,
                'metode_pembayaran' => 'BRI',
                'jumlah_pembayaran' => 1600000,
                'bukti_pembayaran' => 'bukti_5.jpeg',
                'detail_pembayaran' => 'dp',
                'status_pembayaran' => 'diterima',
                'pesan_revisi' => NULL,
                'sewa_id' => 5
            ],
            [
                'id' => 6,
                'metode_pembayaran' => 'BSI',
                'jumlah_pembayaran' => 40000,
                'bukti_pembayaran' => 'bukti_6.jpeg',
                'detail_pembayaran' => 'dp',
                'status_pembayaran' => 'diterima',
                'pesan_revisi' => NULL,
                'sewa_id' => 6
            ],
            [
                'id' => 7,
                'metode_pembayaran' => 'BRI',
                'jumlah_pembayaran' => 45000,
                'bukti_pembayaran' => 'bukti_7.jpeg',
                'detail_pembayaran' => 'dp',
                'status_pembayaran' => 'diterima',
                'pesan_revisi' => NULL,
                'sewa_id' => 7
            ],
            [
                'id' => 8,
                'metode_pembayaran' => 'BCA',
                'jumlah_pembayaran' => 3300000,
                'bukti_pembayaran' => 'bukti_7.jpeg',
                'detail_pembayaran' => 'dp',
                'status_pembayaran' => 'menunggu',
                'pesan_revisi' => NULL,
                'sewa_id' => 8
            ],
        ]);
    }
}
