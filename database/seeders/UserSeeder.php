<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       User::create([
            'name' => 'Nicholas',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // password = 'password'
            'role' => 1, // tambahkan kolom role di tabel users
        ]);

        // User biasa
        User::create([
            'name' => 'Obito',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // password = 'password'
            'role' => 0,
        ]);
    }
}
