<?php

namespace App\Http\Controllers;

use App\Helpers\FilePondHelpers;
use App\Models\Sop;
use App\Models\TemporaryFile;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SopController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat sop')) {
            FilePondHelpers::removeTemporaryFile();
            FilePondHelpers::removeTemporaryImage();

            return view('dashboard.pages.sop.index');
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
                'name' => 'required|string',
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

            Sop::create($validatedData);

            return redirect(route('dashboard.pages.sop.index'))->with('success', 'SOP created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create SOP.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $sop = Sop::findOrFail($id);
            if ($sop->file) {
                $parts = explode('/', $sop->file);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-file/' . $folder);
            }
            if ($sop->image) {
                $parts = explode('/', $sop->image);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-image/' . $folder);
            }
            $sop->delete();

            return response()->json([
                'success' => true,
                'message' => 'SOP deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete SOP.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $sop = Sop::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'SOP find successfully.',
                'data' => $sop,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find SOP.',
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

            $sop = Sop::findOrFail($id);

            $validatedData = request()->validate([
                'name' => 'required|string',
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

            $sop->update($validatedData);

            return redirect()->back()->with('success', 'SOP updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update SOP');
        }
    }

    public function data()
    {
        $sop = Sop::orderBy('id', 'desc')->get();

        return DataTables::of($sop)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('image', function ($row) {
                $image = '<img src="' . asset('storage/filepond-image/' . $row->image) . '" class="object-fit-cover object-position-center" style="width: 8rem; height: auto;">';
                return $row->image ? $image : '-';
            })
            ->addColumn('file', function ($row) {
                $file = '<a href="' . asset('storage/filepond-file/' . $row->file) . '" target="_blank" class="btn btn-inverse-info p-2">Dokumen</a>';
                return $row->file ? $file : '-';
            })
            ->addColumn('link', function ($row) {
                return $row->link ? '<a class="btn btn-inverse-info p-2" href="' . $row->link . '" target="_blank">Drive</a>' : '-';
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit sop') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus sop') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updateSop(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit SOP" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroySop(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus SOP" 
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
