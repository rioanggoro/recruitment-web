<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('passwordadmin'), // Ganti 'password' dengan password yang Anda inginkan
            'role' => 'admin',
        ]);

        // Create Pelamar User
        User::create([
            'name' => 'pelamar',
            'username' => 'pelamar',
            'password' => Hash::make('passwordpelamar'), // Ganti 'password' dengan password yang Anda inginkan
            'role' => 'pelamar',
        ]);
    }
}
