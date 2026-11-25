<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['email'=>'admin@laporwud.test'],[
            'name'=>'Administrator','password'=>'password123','role'=>'admin'
        ]);
        User::firstOrCreate(['email'=>'teknisi@laporwud.test'],[
            'name'=>'Teknisi Demo','password'=>'password123','role'=>'teknisi'
        ]);
        User::firstOrCreate(['email'=>'siswa@laporwud.test'],[
            'name'=>'Siswa Demo','password'=>'password123','role'=>'siswa','class_name'=>'XI RPL'
        ]);
    }
}
