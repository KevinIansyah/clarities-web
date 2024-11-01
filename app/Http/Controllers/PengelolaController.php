<?php

namespace App\Http\Controllers;

use App\Helpers\FilePondHelpers;
use App\Models\Pengelola;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PengelolaController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat pengelola')) {
            FilePondHelpers::removeTemporaryImage();

            return view('dashboard.pages.pengelola.index');
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
                    'position' => 'required|string',
                    'instagram' => 'nullable|string',
                    'facebook' => 'nullable|string',
                    'twitter' => 'nullable|string',
                    'linkedin' => 'nullable|string',
                ]);

                $validatedData['image'] = $tmpFile->folder . '/' . $tmpFile->file;

                Pengelola::create($validatedData);

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('image-law-app');

                return redirect(route('dashboard.pages.pengelola.index'))->with('success', 'Pengelola created successfully.');
            } else {
                throw new \Exception('Temporary files not found or empty.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create pengelola.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $pengelola = Pengelola::findOrFail($id);
            if ($pengelola->image) {
                $parts = explode('/', $pengelola->image);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-image/' . $folder);
            }
            $pengelola->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengelola deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete pengelola.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $pengelola = Pengelola::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Pengelola find successfully.',
                'data' => $pengelola,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find pengelola.',
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

            $pengelola = Pengelola::findOrFail($id);

            $validatedData = request()->validate([
                'name' => 'required|string',
                'position' => 'required|string',
                'instagram' => 'nullable|string',
                'facebook' => 'nullable|string',
                'twitter' => 'nullable|string',
                'linkedin' => 'nullable|string',
            ]);

            $pengelola->update($validatedData);

            if (isset($tmpFile)) {
                $pengelola->update(['image' => $tmpFile->folder . '/' . $tmpFile->file]);

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();

                Session::forget('image-law-app');
            }

            return redirect()->back()->with('success', 'Pengelola updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update pengelola');
        }
    }

    public function data()
    {
        $pengelola = Pengelola::orderBy('id', 'desc')->get();

        return DataTables::of($pengelola)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('position', function ($row) {
                return $row->position;
            })
            ->addColumn('image', function ($row) {
                $image = '<img src="' . asset('storage/filepond-image/' . $row->image) . '" class="object-fit-cover object-position-center" style="width: 8rem; height: auto;">';
                return $image;
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit pengelola') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus pengelola') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updatePengelola(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Pengelola" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyPengelola(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Pengelola" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['image', 'action'])
            ->make(true);
    }
}
