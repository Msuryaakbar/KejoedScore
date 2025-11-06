<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@kejoedscore.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Contoh Guru
        User::create([
            'name' => 'Guru Matematika',
            'email' => 'guru@kejoedscore.com',
            'password' => Hash::make('password123'),
            'role' => 'guru',
        ]);

        // Contoh Orang Tua
        User::create([
            'name' => 'Orang Tua Siswa',
            'email' => 'ortu@kejoedscore.com',
            'password' => Hash::make('password123'),
            'role' => 'ortu',
        ]);
    }
}
