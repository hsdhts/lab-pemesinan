<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    
        User::create([
            'username' => 'mahasiswa',
            'nama' => 'Mahasiswa',
            'level' => 'Mahasiswa',
            'password' => bcrypt('1234'),
            'last_login' => Carbon::parse('17-12-2023 23:34:45'),
        ]);
     
        User::create([
            'username' => 'admin',
            'nama' => 'Just Admin',
            'level' => 'Admin',
            'password' => bcrypt('1234'),
            'last_login' => Carbon::parse('13-01-2023 23:34:45'),
        ]);
        User::create([
            'username' => 'superadmin',
            'nama' => 'Superadmin PTM',
            'level' => 'Superadmin',
            'password' => bcrypt('1234'),
        ]);
    }
}
