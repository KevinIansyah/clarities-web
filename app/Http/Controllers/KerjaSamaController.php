<?php

namespace App\Http\Controllers;

use App\Helpers\FilePondHelpers;
use App\Models\KerjaSama;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KerjaSamaController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat kerjasama')) {
            FilePondHelpers::removeTemporaryImage();

            return view('dashboard.pages.kerja-sama.index');
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

                $validatedData = $request->validate([
                    'name' => 'required|string',
                    'type' => 'required|string|in:eksternal,internal',
                    'link' => 'nullable|string',
                ]);

                $validatedData['image'] = $tmpFile->folder . '/' . $tmpFile->file;

                KerjaSama::create($validatedData);

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('image-law-app');

                return redirect(route('dashboard.pages.kerja-sama.index'))->with('success', 'Kerja sama created successfully.');
            } else {
                throw new \Exception('Temporary files not found or empty.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create kerja sama.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $kerjaSama = KerjaSama::findOrFail($id);
            if ($kerjaSama->image) {
                $parts = explode('/', $kerjaSama->image);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-image/' . $folder);
            }
            $kerjaSama->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kerja sama deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete kerja sama.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $kerjaSama = KerjaSama::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Kerja sama find successfully.',
                'data' => $kerjaSama,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find kerja sama.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update($id)
    {
        try {
            $sessionFile = Session::get('image-law-app');

            if (!empty($sessionFile)) {
                $tmpFile = TemporaryImage::where('folder', $sessionFile)->first();

                Storage::move('post/tmp-filepond-image/' . $tmpFile->folder . '/' . $tmpFile->file, 'filepond-image/' . $tmpFile->folder . '/' . $tmpFile->file);
            }

            $kerjaSama = KerjaSama::findOrFail($id);

            $validatedData = request()->validate([
                'name' => 'required|string',
                'type' => 'required|string|in:eksternal,internal',
                'link' => 'nullable|string',
            ]);

            $kerjaSama->update($validatedData);

            if (isset($tmpFile)) {
                $kerjaSama->update(['image' => $tmpFile->folder . '/' . $tmpFile->file]);

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();

                Session::forget('image-law-app');
            }

            return redirect()->back()->with('success', 'Kerja sama updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update kerja sama');
        }
    }

    public function data()
    {
        $kerjaSama = KerjaSama::orderBy('id', 'desc')->get();

        return DataTables::of($kerjaSama)
            ->addIndexColumn()
            ->addColumn('type', function ($row) {
                $typeLabel = $row->type == 'internal' ? '<label class="badge badge-info mb-0">Internal</label>' : '<label class="badge badge-primary mb-0">Eksternal</label>';
                return $typeLabel;
            })
            ->addColumn('image', function ($row) {
                $image = '<img src="' . asset('storage/filepond-image/' . $row->image) . '" class="object-fit-cover object-position-center" style="width: 8rem; height: auto;">';
                return $image;
            })
            ->addColumn('link', function ($row) {
                return $row->link ? $row->link : '-';
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit kerjasama') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus kerjasama') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updateKerjaSama(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Kerja Sama" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyKerjaSama(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Kerja Sama" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['type', 'image', 'action'])
            ->make(true);
    }
}
