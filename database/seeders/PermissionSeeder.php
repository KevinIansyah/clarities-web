<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'lihat blog']);
        Permission::create(['name' => 'tambah blog']);
        Permission::create(['name' => 'edit blog']);
        Permission::create(['name' => 'hapus blog']);

        Permission::create(['name' => 'lihat bookinglab']);
        Permission::create(['name' => 'tambah bookinglab']);
        Permission::create(['name' => 'edit bookinglab']);
        Permission::create(['name' => 'hapus bookinglab']);

        Permission::create(['name' => 'lihat ruanganlab']);
        Permission::create(['name' => 'tambah ruanganlab']);
        Permission::create(['name' => 'edit ruanganlab']);
        Permission::create(['name' => 'hapus ruanganlab']);

        Permission::create(['name' => 'lihat jadwalpraktikum']);
        Permission::create(['name' => 'tambah jadwalpraktikum']);
        Permission::create(['name' => 'edit jadwalpraktikum']);
        Permission::create(['name' => 'hapus jadwalpraktikum']);
        
        Permission::create(['name' => 'lihat modulpraktikum']);
        Permission::create(['name' => 'tambah modulpraktikum']);
        Permission::create(['name' => 'edit modulpraktikum']);
        Permission::create(['name' => 'hapus modulpraktikum']);
        
        Permission::create(['name' => 'lihat kurikulumlab']);
        Permission::create(['name' => 'tambah kurikulumlab']);
        Permission::create(['name' => 'edit kurikulumlab']);
        Permission::create(['name' => 'hapus kurikulumlab']);

        Permission::create(['name' => 'lihat tujuan']);
        Permission::create(['name' => 'tambah tujuan']);
        Permission::create(['name' => 'edit tujuan']);
        Permission::create(['name' => 'hapus tujuan']);

        Permission::create(['name' => 'lihat visimisi']);
        Permission::create(['name' => 'tambah visimisi']);
        Permission::create(['name' => 'edit visimisi']);
        Permission::create(['name' => 'hapus visimisi']);

        Permission::create(['name' => 'lihat pengelola']);
        Permission::create(['name' => 'tambah pengelola']);
        Permission::create(['name' => 'edit pengelola']);
        Permission::create(['name' => 'hapus pengelola']);

        Permission::create(['name' => 'lihat fasilitas']);
        Permission::create(['name' => 'tambah fasilitas']);
        Permission::create(['name' => 'edit fasilitas']);
        Permission::create(['name' => 'hapus fasilitas']);

        Permission::create(['name' => 'lihat strukturorganisasi']);
        Permission::create(['name' => 'tambah strukturorganisasi']);
        Permission::create(['name' => 'edit strukturorganisasi']);
        Permission::create(['name' => 'hapus strukturorganisasi']);

        Permission::create(['name' => 'lihat unitbagian']);
        Permission::create(['name' => 'tambah unitbagian']);
        Permission::create(['name' => 'edit unitbagian']);
        Permission::create(['name' => 'hapus unitbagian']);

        Permission::create(['name' => 'lihat sop']);
        Permission::create(['name' => 'tambah sop']);
        Permission::create(['name' => 'edit sop']);
        Permission::create(['name' => 'hapus sop']);

        Permission::create(['name' => 'lihat kerjasama']);
        Permission::create(['name' => 'tambah kerjasama']);
        Permission::create(['name' => 'edit kerjasama']);
        Permission::create(['name' => 'hapus kerjasama']);

        Permission::create(['name' => 'lihat pelatihan']);
        Permission::create(['name' => 'tambah pelatihan']);
        Permission::create(['name' => 'edit pelatihan']);
        Permission::create(['name' => 'hapus pelatihan']);

        Permission::create(['name' => 'lihat kalenderakademik']);
        Permission::create(['name' => 'tambah kalenderakademik']);
        Permission::create(['name' => 'edit kalenderakademik']);
        Permission::create(['name' => 'hapus kalenderakademik']);
    }
}
