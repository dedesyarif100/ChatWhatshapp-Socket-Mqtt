<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'name' => 'dede syarifudin',
                'email' => 'dedesyarif@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Putu Mahardika',
                'email' => 'putu@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Agung Setyo Pribadi',
                'email' => 'agung@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ekky Sukmawati',
                'email' => 'ekky@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Andrew Nangoy',
                'email' => 'andrew@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'bariq Qusoyii',
                'email' => 'bariq@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'nofrian firsnanda',
                'email' => 'nofri@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Serapion Kusuma',
                'email' => 'sera@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Aziz Ainun Najib',
                'email' => 'aziz@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Taufik Hidayat',
                'email' => 'taufik@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mario Gulo',
                'email' => 'mario@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Achmadi',
                'email' => 'adi@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rizky Fairuz',
                'email' => 'fairuz@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Febriyanti Elizabeth Sailolin',
                'email' => 'febby@mail.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
