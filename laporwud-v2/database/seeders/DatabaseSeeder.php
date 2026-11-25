<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@laporwud.test'], [
            'name' => 'Administrator',
            'password' => 'password123',
            'role' => 'admin',
        ]);
        User::updateOrCreate(['email' => 'teknisi@laporwud.test'], [
            'name' => 'Teknisi Demo',
            'password' => 'password123',
            'role' => 'teknisi',
        ]);
        User::updateOrCreate(['nis' => '1234567890'], [
            'name' => 'Siswa Demo',
            'email' => 'siswa@laporwud.test',
            'nis' => '1234567890',
            'password' => 'password123',
            'role' => 'siswa',
            'class_name' => 'XI RPL',
        ]);
    }
}
