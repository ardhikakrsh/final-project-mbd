<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            TipeKendaraanSeeder::class,
            PemilikSeeder::class,
            KendaraanSeeder::class,
            PelangganSeeder::class,
            ReviewSeeder::class,
            SewaSeeder::class,
            PembayaranSeeder::class,
            PengembalianSeeder::class
        ]);
    }
}
