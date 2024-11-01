<?php

namespace App\Http\Controllers;

use App\Helpers\FilePondHelpers;
use App\Models\StrukturOrganisasi;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat strukturorganisasi')) {
            FilePondHelpers::removeTemporaryImage();

            $strukturOrganisasi = StrukturOrganisasi::first();

            return view('dashboard.pages.struktur-organisasi.index', compact('strukturOrganisasi'));
        } else {
            return abort(403);
        }
    }

    public function create() {}

    public function store(Request $request)
    {
        try {
            $sessionFile = Session::get('image-law-app');

            if (!empty($sessionFile)) {
                $tmpFile = TemporaryImage::where('folder', $sessionFile)->first();
            } else {
                throw new \Exception('Temporary files not found.');
            }

            if ($tmpFile) {
                Storage::move('post/tmp-filepond-image/' . $tmpFile->folder . '/' . $tmpFile->file, 'filepond-image/' . $tmpFile->folder . '/' . $tmpFile->file);

                $validatedData['image'] = $tmpFile->folder . '/' . $tmpFile->file;

                $strukturOrganisasi = StrukturOrganisasi::first();
                if ($strukturOrganisasi) {
                    $strukturOrganisasi->update($validatedData);
                    $message = 'Struktur organisasi updated successfully.';
                } else {
                    StrukturOrganisasi::create($validatedData);
                    $message = 'Struktur organisasi created successfully.';
                }

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('image-law-app');

                return redirect(route('dashboard.pages.struktur-organisasi.index'))->with('success', $message);
            } else {
                throw new \Exception('Temporary files not found or empty.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create struktur organisasi.');
        }
    }

    public function show() {}

    public function destroy($id) {}

    public function edit($id) {}

    public function update($id) {}
}
