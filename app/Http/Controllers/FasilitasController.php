<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class FasilitasController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat fasilitas')) {
            return view('dashboard.pages.fasilitas.index');
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
                    'content' => 'required|string',
                ]);

                $validatedData['image'] = $tmpFile->folder . '/' . $tmpFile->file;

                Fasilitas::create($validatedData);

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('image-law-app');

                return redirect(route('dashboard.pages.fasilitas.index'))->with('success', 'Fasilitas created successfully.');
            } else {
                throw new \Exception('Temporary files not found or empty.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create fasilitas.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $fasilitas = Fasilitas::findOrFail($id);
            if ($fasilitas->image) {
                $parts = explode('/', $fasilitas->image);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-image/' . $folder);
            }
            $fasilitas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Fasilitas deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete fasilitas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $fasilitas = Fasilitas::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Fasilitas find successfully.',
                'data' => $fasilitas,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find fasilitas.',
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

            $fasilitas = Fasilitas::findOrFail($id);

            $validatedData = request()->validate([
                'name' => 'required|string',
                'content' => 'required|string',
            ]);

            $fasilitas->update($validatedData);

            if (isset($tmpFile)) {
                $fasilitas->update(['image' => $tmpFile->folder . '/' . $tmpFile->file]);

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();

                Session::forget('image-law-app');
            }

            return redirect()->back()->with('success', 'Fasilitas updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update fasilitas');
        }
    }

    public function data()
    {
        $fasilitas = Fasilitas::orderBy('id', 'desc')->get();

        return DataTables::of($fasilitas)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('image', function ($row) {
                $image = '<img src="' . asset('storage/filepond-image/' . $row->image) . '" class="object-fit-cover object-position-center" style="width: 8rem; height: auto;">';
                return $image;
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit fasilitas') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus fasilitas') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updateFasilitas(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Fasilitas" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyFasilitas(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Fasilitas" 
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
