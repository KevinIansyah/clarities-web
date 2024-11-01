<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Pengelola;
use App\Models\StrukturOrganisasi;
use App\Models\Tujuan;
use App\Models\UnitBagian;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class FrontProfileController extends Controller
{
    function tujuan()
    {
        $tujuan = Tujuan::orderBy('id', 'asc')->get();

        return view('profile.tujuan', compact('tujuan'));
    }

    function visiMisi()
    {
        $visi = VisiMisi::latest()->where('type', 'visi')->first();
        $misi = VisiMisi::orderBy('id', 'asc')->where('type', 'misi')->get();

        return view('profile.visi-misi', compact('visi', 'misi'));
    }

    function strukturOrganisasi()
    {
        $strukturOrganisasi = StrukturOrganisasi::first();

        return view('profile.struktur-organisasi', compact('strukturOrganisasi'));
    }

    function unitBagian()
    {
        $unitBagian = UnitBagian::orderBy('id', 'asc')->get();

        return view('profile.unit-bagian', compact('unitBagian'));
    }

    function pengelola()
    {
        $pengelola = Pengelola::orderBy('id', 'asc')->get();

        return view('profile.pengelola', compact('pengelola'));
    }

    function fasilitas()
    {
        $fasilitas = Fasilitas::orderBy('id', 'asc')->get();

        return view('profile.fasilitas', compact('fasilitas'));
    }
}
