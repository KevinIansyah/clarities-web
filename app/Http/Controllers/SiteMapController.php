<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteMapController extends Controller
{
    public function index()
    {
        $staticUrls = [
            [
                'loc' => url('/'),
                'priority' => '1.00',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/profil/tujuan'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/profil/visi-misi'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/profil/struktur-organisasi'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/profil/unit-bagian'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/profil/pengelola'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/profil/fasilitas'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/praktikum/modul-praktikum'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/praktikum/jadwal-praktikum'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/praktikum/kurikulum-lab'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/praktikum/peminjaman-ruang-lab'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/informasi/sop'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/informasi/kerja-sama'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/informasi/pelatihan'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
            [
                'loc' => url('/informasi/kalender-akademik'),
                'priority' => '0.80',
                'lastmod' => Carbon::now()->tz('UTC')->toAtomString(),
            ],
        ];

        $blogUrls = DB::table('blogs')
            ->select('slug', 'updated_at')
            ->get()
            ->map(function ($blog) {
                return [
                    'loc' => url("/blog/{$blog->slug}"),
                    'priority' => '0.80',
                    'lastmod' => Carbon::parse($blog->updated_at)->tz('UTC')->toAtomString(),
                ];
            });

        $pelatihanUrls = DB::table('pelatihans')
            ->select('slug', 'updated_at')
            ->get()
            ->map(function ($pelatihan) {
                return [
                    'loc' => url("/pelatihan/{$pelatihan->slug}"),
                    'priority' => '0.80',
                    'lastmod' => Carbon::parse($pelatihan->updated_at)->tz('UTC')->toAtomString(),
                ];
            });

        $urls = array_merge(
            $staticUrls,
            $blogUrls->toArray(),
            $pelatihanUrls->toArray()
        );

        return response()->view('sitemap', compact('urls'))->header('Content-Type', 'application/xml');
    }
}
