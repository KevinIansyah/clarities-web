<?php

namespace Database\Seeders;

use App\Models\Tujuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tujuan::create([
            'content' => 'Memastikan fasilitas dan lingkungan belajar yang modern dan kondusif untuk mendukung kegiatan praktikum hukum.',
        ]);

        Tujuan::create([
            'content' => 'Menyusun dan mengembangkan kurikulum praktikum hukum yang selalu diperbaharui sesuai dengan perkembangan terbaru dalam dunia hukum dan kebutuhan masyarakat.',
        ]);

        Tujuan::create([
            'content' => 'Mendorong dan memfasilitasi penelitian hukum yang inovatif, yang mampu memberikan solusi atas permasalahan hukum aktual yang dihadapi oleh masyarakat.',
        ]);

        Tujuan::create([
            'content' => 'Menjalin kolaborasi dengan institusi hukum, baik nasional maupun internasional, untuk meningkatkan kualitas dan relevansi penelitian yang dilakukan.',
        ]);

        Tujuan::create([
            'content' => 'Mengimplementasikan hasil penelitian hukum dalam bentuk kegiatan pengabdian kepada masyarakat untuk memberikan kontribusi nyata dalam penyelesaian masalah hukum.',
        ]);

        Tujuan::create([
            'content' => 'Menyelenggarakan program penyuluhan hukum dan bantuan hukum yang terstruktur dan berkelanjutan bagi masyarakat yang membutuhkan.',
        ]);

        Tujuan::create([
            'content' => 'Meningkatkan kapasitas dan kompetensi staf pengajar dan tenaga kependidikan melalui program pelatihan dan pengembangan profesional yang berkesinambungan.',
        ]);

        Tujuan::create([
            'content' => 'Mendorong partisipasi aktif staf dalam berbagai forum ilmiah dan kegiatan akademik di tingkat nasional maupun internasional untuk memperluas wawasan dan meningkatkan kualitas pengajaran.',
        ]);

        Tujuan::create([
            'content' => 'Mengembangkan sistem informasi dan manajemen laboratorium yang efisien dan efektif untuk mendukung operasional serta layanan kepada sivitas akademika dan masyarakat.',
        ]);

        Tujuan::create([
            'content' => 'Menghasilkan Sarjana Hukum yang professional dan Humanis yang berwawasan Global, memahami HAM dan berjiwa Wirausaha (entrepreneurship).',
        ]);

        Tujuan::create([
            'content' => 'Menghasilkan sarjana hukum sebagai peneliti yang mampu melakukan pengembangan keilmuan hukum.',
        ]);

        Tujuan::create([
            'content' => 'Menghasilkan sarjana hukum yang mampu menggunakan hukum sebagai sarana untuk memecahkan masalah kemasyarakatan dengan bijak dan berdasar asas/ prinsip keadilan dan hukum.',
        ]);

        Tujuan::create([
            'content' => 'Menghasilkan kerjasama dengan berbagai pihak baik dalam maupun luar negeri dalam upaya meningkatkan mutu lulusan Fakultas Hukum Universitas Pembangunan Nasional Veteran Jawa Timur.',
        ]);

        Tujuan::create([
            'content' => 'Mengembangkan tata kelola kelembagaan Laboratorium Hukum.',
        ]);
    }
}
