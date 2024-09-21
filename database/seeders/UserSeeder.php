<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Enums\RolesType;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin GoRent',
                'email' => 'admin@gorent.com',
                'password' => hash::make('admin123'),
                'role' => RolesType::ADMIN,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Iqbal',
                'email' => 'iqbal@gmail.com',
                'password' => hash::make('iqbal123'),
                'role' => RolesType::USER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Feti',
                'email' => 'feti@gmail.com',
                'password' => hash::make('feti123'),
                'role' => RolesType::USER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Dhika',
                'email' => 'dhika@gorent.com',
                'password' => hash::make('dhika123'),
                'role' => RolesType::USER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Mulyanto',
                'email' => 'mulyanto@gorent.com',
                'password' => hash::make('mulyanto123'),
                'role' => RolesType::OWNER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Arhan',
                'email' => 'arhan@gorent.com',
                'password' => hash::make('arhan123'),
                'role' => RolesType::OWNER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'name' => 'Struick',
                'email' => 'struick@gorent.com',
                'password' => hash::make('struick123'),
                'role' => RolesType::OWNER,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
