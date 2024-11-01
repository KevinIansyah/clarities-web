<?php

namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VisiMisi::create([
            'type' => 'visi',
            'content' => 'Menjadi laboratorium hukum yang unggul dan inovatif dalam pendidikan, penelitian, dan pengabdian masyarakat, serta berperan aktif dalam pengembangan ilmu hukum yang relevan dengan dinamika masyarakat dan tantangan global.',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Menyediakan fasilitas dan lingkungan belajar yang kondusif untuk mendukung pengembangan kompetensi mahasiswa dalam bidang hukum. (Pendidikan)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Mengembangkan kurikulum praktikum hukum yang sesuai dengan perkembangan terbaru dalam dunia hukum dan kebutuhan masyarakat. (Pendidikan)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Mendorong dan memfasilitasi penelitian hukum yang inovatif dan berorientasi pada solusi atas permasalahan hukum yang dihadapi oleh masyarakat. (Penelitian)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Berkolaborasi dengan institusi hukum, baik nasional maupun internasional, untuk meningkatkan kualitas dan relevansi penelitian. (Penelitian)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Mengimplementasikan hasil penelitian hukum dalam bentuk pengabdian kepada masyarakat untuk memberikan kontribusi nyata dalam penyelesaian masalah hukum. (Pengabdian Masyarakat)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Mengadakan program-program penyuluhan hukum dan bantuan hukum bagi masyarakat yang membutuhkan. (Pengabdian Masyarakat)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Meningkatkan kapasitas dan kompetensi staf pengajar dan tenaga kependidikan melalui program pelatihan dan pengembangan profesional yang berkelanjutan. (Pengembangan SDM)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Mendorong partisipasi aktif staf dalam forum-forum ilmiah dan kegiatan akademik lainnya di tingkat nasional maupun internasional. (Pengembangan SDM)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Memperkuat dan memperbaharui fasilitas laboratorium hukum dengan teknologi terkini untuk mendukung kegiatan pendidikan, penelitian, dan pengabdian masyarakat. (Infrastruktur dan Teknologi)',
        ]);

        VisiMisi::create([
            'type' => 'misi',
            'content' => 'Mengembangkan sistem informasi dan manajemen laboratorium yang efisien untuk mendukung operasional dan layanan kepada sivitas akademika dan masyarakat. (Infrastruktur dan Teknologi)',
        ]);
    }
}
