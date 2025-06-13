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
            'username' => 'mahasiswa1',
            'nama' => 'Aku Mahasiswa',
            'level' => 'Mahasiswa',
            'email' => 'mahasiswa1@gmail.com',
            'password' => bcrypt('1234'),
            'last_login' => Carbon::parse('17-12-2023 23:34:45'),
        ]);
     

        User::create([
            'username' => 'admin',
            'nama' => 'Just Admin',
            'level' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'last_login' => Carbon::parse('13-01-2023 23:34:45'),
        ]);
        User::create([
            'username' => 'superadmin',
            'nama' => 'Superadmin ',
            'level' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('1234'),
        ]);
    }
}
