<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kendaraan')->insert([
            [
                'id' => 1,
                'nama' => 'Sprint S 150 ABS',
                'merk' => 'Vespa',
                'plat' => 'L 3823 BAA',
                'warna' => 'Abu-abu',
                'kondisi' => 'Bagus,2 bulan kali pemakaian',
                'harga' => 75000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 3,
                'foto' => 'vespa.jpg'
            ],
            [
                'id' => 2,
                'nama' => 'Ninja ZX 25R',
                'merk' => 'Kawasaki',
                'plat' => 'L 4733 KO',
                'warna' => 'Black',
                'kondisi' => 'Baru keluar dari showroom',
                'harga' => 80000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 2,
                'foto' => 'zx25r.jpeg'
            ],
            [
                'id' => 3,
                'nama' => 'Beat 150',
                'merk' => 'Honda',
                'plat' => 'B 4728 HAH',
                'warna' => 'Hitam',
                'kondisi' => 'Lecet bodi motor bagian kanan',
                'harga' => 45000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 1,
                'foto' => 'beat.jpg'
            ],
            [
                'id' => 4,
                'nama' => 'Xeon GT 125',
                'merk' => 'Yamaha',
                'plat' => 'B 3188 SOE',
                'warna' => 'hitam',
                'kondisi' => 'Cukup baik, 3 tahun pemakaian',
                'harga' => 40000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 1,
                'foto' => 'xeon.jpg'
            ],
            [
                'id' => 5,
                'nama' => 'NMAX 155 ABS',
                'merk' => 'Yamaha',
                'plat' => 'DK 7281 IU',
                'warna' => 'Abu-abu',
                'kondisi' => 'Cukup baik, 3 tahun pemakaian',
                'harga' => 65000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 1,
                'foto' => 'nmax.jpg'
            ],
            [
                'id' => 6,
                'nama' => 'Brio RS',
                'merk' => 'Honda',
                'plat' => 'L 2034 XY',
                'warna' => 'Putih',
                'kondisi' => 'Pintu kedap suara',
                'harga' => 100000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 3,
                'foto' => 'brio1.jpg'
            ],
            [
                'id' => 7,
                'nama' => 'Xenia 2023',
                'merk' => 'Daihatsu',
                'plat' => 'N 4381 QE',
                'warna' => 'Hitam',
                'kondisi' => 'AC tidak dingin',
                'harga' => 110000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 1,
                'foto' => 'xeniaa.jpg'
            ],
            [
                'id' => 8,
                'nama' => 'Scirocco',
                'merk' => 'Volkswagen',
                'plat' => 'B 8219 XL',
                'warna' => 'Putih',
                'kondisi' => 'Bagus seperti baru',
                'harga' => 280000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 2,
                'foto' => 'scirocco.webp'
            ],
            [
                'id' => 9,
                'nama' => 'Ioniq 5',
                'merk' => 'Hyundai',
                'plat' => 'L 157 RIK',
                'warna' => 'Gold Matte',
                'kondisi' => 'Kaca film mengelupas',
                'harga' => 300000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 3,
                'foto' => 'ioniq.jpg'
            ],
            [
                'id' => 10,
                'nama' => 'HRV',
                'merk' => 'Honda',
                'plat' => 'AB 2394 HK',
                'warna' => 'Hitam',
                'kondisi' => 'Pemakaian 2 tahun',
                'harga' => 150000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 1,
                'foto' => 'hrv.jpeg'
            ],
            [
                'id' => 11,
                'nama' => 'Jazz 2018',
                'merk' => 'Honda',
                'plat' => 'N 2303 AA',
                'warna' => 'Abu-abu',
                'kondisi' => 'Baik, Service rutin',
                'harga' => 150000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 1,
                'foto' => 'jazz.jpeg'
            ],
            [
                'id' => 12,
                'nama' => 'Fortuner 2018',
                'merk' => 'Toyota',
                'plat' => 'AG 8238 PD',
                'warna' => 'Hitam',
                'kondisi' => 'Bagus seperti baru',
                'harga' => 200000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 3,
                'foto' => 'fortuner.jpeg'
            ],
            [
                'id' => 13,
                'nama' => 'Vario 2015',
                'merk' => 'Honda',
                'plat' => 'S 0239 PQ',
                'warna' => 'Abu-abu',
                'kondisi' => 'Spakbor depan lecet',
                'harga' => 45000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 3,
                'foto' => 'vario.jpeg'
            ],
            [
                'id' => 14,
                'nama' => 'Scoopy 2020',
                'merk' => 'Honda',
                'plat' => 'L 3839 JA',
                'warna' => 'Matte brown',
                'kondisi' => 'Lampu sein mati',
                'harga' => 45000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 2,
                'foto' => 'scoopy.jpeg'
            ],
            [
                'id' => 15,
                'nama' => 'Fazzio',
                'merk' => 'Yamaha',
                'plat' => 'B 6095 SXZ',
                'warna' => 'Tosca',
                'kondisi' => 'Baru',
                'harga' => 50000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 1,
                'foto' => 'fazzio.jpeg'
            ],
            [
                'id' => 16,
                'nama' => 'Aerox',
                'merk' => 'Yamaha',
                'plat' => 'B 2012 XYZ',
                'warna' => 'Hitam biru',
                'kondisi' => 'Bekas dan terawat',
                'harga' => 55000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 2,
                'foto' => 'aerox.jpeg'
            ],
            [
                'id' => 17,
                'nama' => 'CBR 150R 2016',
                'merk' => 'Yamaha',
                'plat' => 'B 3159 CEP',
                'warna' => 'Merah',
                'kondisi' => 'Bekas dan full modif',
                'harga' => 70000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 3,
                'foto' => 'cbr.jpeg'
            ],
            [
                'id' => 18,
                'nama' => 'MT-15',
                'merk' => 'Yamaha',
                'plat' => 'D 8123 LW',
                'warna' => 'Silver',
                'kondisi' => 'Penggunaan 1 tahun',
                'harga' => 55000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 2,
                'foto' => 'mt15.jpeg'
            ],
            [
                'id' => 19,
                'nama' => 'PCX',
                'merk' => 'Yamaha',
                'plat' => 'B 4467 SMX',
                'warna' => 'Putih',
                'kondisi' => 'Baru',
                'harga' => 65000,
                'tipe_kendaraan_id' => 1,
                'pemilik_id' => 3,
                'foto' => 'pcx.jpeg'
            ],
            [
                'id' => 20,
                'nama' => 'CRV 2016',
                'merk' => 'Yamaha',
                'plat' => 'D 1134 SH',
                'warna' => 'Putih',
                'kondisi' => 'Folklamp mati',
                'harga' => 175000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 1,
                'foto' => 'crv.jpeg'
            ],
            [
                'id' => 21,
                'nama' => 'Pajero Sport',
                'merk' => 'Mitshubishi',
                'plat' => 'L 2931 KA',
                'warna' => 'Hitam',
                'kondisi' => 'Pemakaian 2 bulan',
                'harga' => 220000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 1,
                'foto' => 'pajero.jpeg'
            ],
            [
                'id' => 22,
                'nama' => 'FT 86 2014',
                'merk' => 'Toyota',
                'plat' => 'B 1150 DIG',
                'warna' => 'Orange',
                'kondisi' => 'Ganti mesin',
                'harga' => 250000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 2,
                'foto' => 'ft86.jpeg'
            ],
            [
                'id' => 23,
                'nama' => 'Rubicon',
                'merk' => 'Jeep',
                'plat' => 'B 1150 DIG',
                'warna' => 'Orange',
                'kondisi' => 'Bekas pejabat',
                'harga' => 400000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 3,
                'foto' => 'rubicon.jpeg'
            ],
            [
                'id' => 24,
                'nama' => 'GR Yaris',
                'merk' => 'Toyota',
                'plat' => 'L 2503 DK',
                'warna' => 'Hitam',
                'kondisi' => 'Baru keluar dari showroom',
                'harga' => 400000,
                'tipe_kendaraan_id' => 2,
                'pemilik_id' => 2,
                'foto' => 'GRyaris.jpeg'
            ],
            [
                'id' => 25,
                'nama' => 'AK240',
                'merk' => 'Hino',
                'plat' => 'BG 7924 AO',
                'warna' => 'Putih',
                'kondisi' => 'Lampu rem mati sebelah',
                'harga' => 600000,
                'tipe_kendaraan_id' => 3,
                'pemilik_id' => 3,
                'foto' => 'hinoak240.jpeg'
            ],
            [
                'id' => 26,
                'nama' => 'OH 1626JB',
                'merk' => 'Mercedez-Benz',
                'plat' => 'D 7770 JH',
                'warna' => 'Biru muda',
                'kondisi' => 'Baru selesai service',
                'harga' => 750000,
                'tipe_kendaraan_id' => 3,
                'pemilik_id' => 2,
                'foto' => 'OH1626JB.jpeg'
            ],
            [
                'id' => 27,
                'nama' => 'K360IB',
                'merk' => 'Scania',
                'plat' => 'AD 1602 DF',
                'warna' => 'Merah',
                'kondisi' => 'Bagus seperti baru',
                'harga' => 700000,
                'tipe_kendaraan_id' => 3,
                'pemilik_id' => 2,
                'foto' => 'scania.jpeg'
            ],
            [
                'id' => 28,
                'nama' => 'B11R',
                'merk' => 'Volvo',
                'plat' => 'AD 1602 DF',
                'warna' => 'Silver',
                'kondisi' => 'Cat baru',
                'harga' => 650000,
                'tipe_kendaraan_id' => 3,
                'pemilik_id' => 1,
                'foto' => 'volvob11r.jpeg'
            ],
            [
                'id' => 29,
                'nama' => 'R260',
                'merk' => 'Hino',
                'plat' => 'L 3041 LA',
                'warna' => 'Ungu',
                'kondisi' => 'Penggunaan 2 tahun',
                'harga' => 750000,
                'tipe_kendaraan_id' => 3,
                'pemilik_id' => 1,
                'foto' => 'r260.jpeg'
            ],
            [
                'id' => 30,
                'nama' => 'OH 1626L',
                'merk' => 'Mercedez-Benz',
                'plat' => 'L 9128 AX',
                'warna' => 'Hitam',
                'kondisi' => 'Baru',
                'harga' => 800000,
                'tipe_kendaraan_id' => 3,
                'pemilik_id' => 3,
                'foto' => 'OH1626L.jpeg'
            ],
        ]);
    }
}
