<?php

namespace App\Http\Controllers;

use App\Helpers\FilePondHelpers;
use App\Models\KalenderAkademik;
use App\Models\TemporaryFile;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KalenderAkademikController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat kalenderakademik')) {
            FilePondHelpers::removeTemporaryFile();
            FilePondHelpers::removeTemporaryImage();

            return view('dashboard.pages.kalender-akademik.index');
        } else {
            return abort(403);
        }
    }

    public function create() {}

    public function store(Request $request)
    {
        try {
            $sessionFile = Session::get('file-law-app');
            $sessionImage = Session::get('image-law-app');

            $validatedData = $request->validate([
                'tahun_akademik' => 'required|string',
                'link' => 'nullable|string',
            ]);

            if (!empty($sessionFile)) {
                $tmpFile = TemporaryFile::where('folder', $sessionFile)->first();

                if ($tmpFile) {
                    Storage::move('post/tmp-filepond-file/' . $tmpFile->folder . '/' . $tmpFile->file, 'filepond-file/' . $tmpFile->folder . '/' . $tmpFile->file);

                    $validatedData['file'] = $tmpFile->folder . '/' . $tmpFile->file;

                    Storage::deleteDirectory('post/tmp-filepond-file/' . $tmpFile->folder);
                    $tmpFile->delete();
                    Session::forget('file-law-app');
                }
            }

            if (!empty($sessionImage)) {
                $tmpImage = TemporaryImage::where('folder', $sessionImage)->first();

                if ($tmpImage) {
                    Storage::move('post/tmp-filepond-image/' . $tmpImage->folder . '/' . $tmpImage->file, 'filepond-image/' . $tmpImage->folder . '/' . $tmpImage->file);

                    $validatedData['image'] = $tmpImage->folder . '/' . $tmpImage->file;

                    Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpImage->folder);
                    $tmpImage->delete();
                    Session::forget('image-law-app');
                }
            }

            KalenderAkademik::create($validatedData);

            return redirect(route('dashboard.pages.kalender-akademik.index'))->with('success', 'Kalender akademik created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create kalender akademik.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $kalenderAkademik = KalenderAkademik::findOrFail($id);
            if ($kalenderAkademik->file) {
                $parts = explode('/', $kalenderAkademik->file);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-file/' . $folder);
            }
            $kalenderAkademik->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kalender akademik deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete kalender akademik.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $kalenderAkademik = KalenderAkademik::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Kalender akademik find successfully.',
                'data' => $kalenderAkademik,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find kalender akademik.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update($id)
    {
        try {
            $sessionFile = Session::get('file-law-app');
            $sessionImage = Session::get('image-law-app');

            if (!empty($sessionFile)) {
                $tmpFile = TemporaryFile::where('folder', $sessionFile)->first();
                Storage::move('post/tmp-filepond-file/' . $tmpFile->folder . '/' . $tmpFile->file, 'filepond-file/' . $tmpFile->folder . '/' . $tmpFile->file);
            }

            if (!empty($sessionImage)) {
                $tmpImage = TemporaryImage::where('folder', $sessionImage)->first();
                Storage::move('post/tmp-filepond-image/' . $tmpImage->folder . '/' . $tmpImage->file, 'filepond-image/' . $tmpImage->folder . '/' . $tmpImage->file);
            }

            $kalenderAkademik = KalenderAkademik::findOrFail($id);

            $validatedData = request()->validate([
                'tahun_akademik' => 'required|string',
                'link' => 'nullable|string',
            ]);

            if (isset($tmpFile)) {
                $validatedData['file'] = $tmpFile->folder . '/' . $tmpFile->file;
                Storage::deleteDirectory('post/tmp-filepond-file/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('file-law-app');
            }

            if (isset($tmpImage)) {
                $validatedData['image'] = $tmpImage->folder . '/' . $tmpImage->file;
                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpImage->folder);
                $tmpImage->delete();
                Session::forget('image-law-app');
            }

            $kalenderAkademik->update($validatedData);

            return redirect()->back()->with('success', 'Kalender akademik updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update kalender akademik');
        }
    }

    public function data()
    {
        $kalenderAkademik = KalenderAkademik::orderBy('id', 'desc')->get();

        return DataTables::of($kalenderAkademik)
            ->addIndexColumn()
            ->addColumn('tahun_akademik', function ($row) {
                return $row->tahun_akademik;
            })
            ->addColumn('file', function ($row) {
                $file = '<a href="' . asset('storage/filepond-file/' . $row->file) . '" target="_blank" class="btn btn-inverse-info p-2">Dokumen</a>';
                return $row->file ? $file : '-';
            })
            ->addColumn('image', function ($row) {
                $image = '<img src="' . asset('storage/filepond-image/' . $row->image) . '" class="object-fit-cover object-position-center" style="width: 8rem; height: auto;">';
                return $row->image ? $image : '-';
            })
            ->addColumn('link', function ($row) {
                return $row->link ? '<a class="btn btn-inverse-info p-2" href="' . $row->link . '" target="_blank">Drive</a>' : '-';
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit kalenderakademik') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus kalenderakademik') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updateKalenderAkademik(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Kalender Akademik" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyKalenderAkademik(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Kalender Akademik" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['image', 'file', 'link', 'action'])
            ->make(true);
    }
}
