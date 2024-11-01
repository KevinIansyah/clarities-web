<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use App\Models\KerjaSama;
use App\Models\Pelatihan;
use App\Models\Sop;
use Illuminate\Http\Request;

class FrontInformationController extends Controller
{
    function sop()
    {
        $sop = Sop::orderBy('id', 'desc')->get();

        return view('informasi.sop', compact('sop'));
    }

    function kalender()
    {
        $kalenderAkademik = KalenderAkademik::orderBy('id', 'desc')->get();

        return view('informasi.kalender', compact('kalenderAkademik'));
    }

    function pelatihan(Request $request)
    {
        $pelatihan = Pelatihan::where('status', 'active')->orderBy('id', 'desc');

        if ($request->search) {
            $pelatihan->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->tag) {
            $pelatihan->where('tag', 'like', '%' . $request->tag . '%');
        }

        $pelatihan = $pelatihan->paginate(12);

        return view('informasi.pelatihan', compact('pelatihan'));
    }

    function detailPelatihan($slug)
    {
        $pelatihan = Pelatihan::with('user')->where('slug', $slug)->firstOrFail();
        $latestPelatihan = Pelatihan::where('status', 'active')->orderBy('id', 'desc')->limit(5)->get();

        $pelatihan->increment('view');

        return view('informasi.detail-pelatihan', compact('pelatihan', 'latestPelatihan'));
    }

    function kerjaSama()
    {
        $kerjaSama = KerjaSama::orderBy('id', 'desc')->get();

        return view('informasi.kerja-sama', compact('kerjaSama'));
    }
}
