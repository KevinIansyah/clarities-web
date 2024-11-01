<?php

namespace Database\Seeders;

use App\Models\RoomLab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomLab::create([
            'name' => 'Ruangan 1',
            'status' => 'active',
        ]);

        RoomLab::create([
            'name' => 'Ruangan 2',
            'status' => 'active',
        ]);

        RoomLab::create([
            'name' => 'Ruangan 3',
            'status' => 'active',
        ]);
    }
}
