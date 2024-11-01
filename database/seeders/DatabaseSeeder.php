<?php

use Database\Seeders\BlogSeeder;
use Database\Seeders\PageViewSeeder;
use Database\Seeders\PengelolaSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\RoomLabSeeder;
use Database\Seeders\StrukturOrganisasiSeeder;
use Database\Seeders\TujuanSeeder;
use Database\Seeders\VisiMisiSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(TujuanSeeder::class);
        $this->call(VisiMisiSeeder::class);
        $this->call(PageViewSeeder::class);
        $this->call(StrukturOrganisasiSeeder::class);
        $this->call(RoomLabSeeder::class);
    }
}
