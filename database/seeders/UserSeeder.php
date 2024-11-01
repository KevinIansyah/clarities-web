<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'gender' => 'perempuan',
            'password' => Hash::make('123456'),
            'access' => 'admin',
            'status' => 'active',
        ])->assignRole('admin');

        User::create([
            'name' => 'Kevin Iansyah',
            'email' => 'keviniansyah04@gmail.com',
            'gender' => 'laki-laki',
            'password' => Hash::make('123456'),
            'access' => 'admin',
            'status' => 'active',
        ])->assignRole('admin');
    }
}
