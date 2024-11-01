<?php

namespace Database\Seeders;

use App\Models\PageView;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageView::create([
            'views' => 0,
        ]);
    }
}
