<?php

namespace App\Http\Controllers;

use App\Helpers\FilePondHelpers;
use App\Models\Pelatihan;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PelatihanController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat pelatihan')) {
            return view('dashboard.pages.pelatihan.index');
        } else {
            return abort(403);
        }
    }

    public function create()
    {
        if (auth()->user()->can('tambah pelatihan')) {
            FilePondHelpers::removeTemporaryImage();

            return view('dashboard.pages.pelatihan.add');
        } else {
            return abort(403);
        }
    }

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
                    'title' => 'required|string',
                    'overview' => 'required|string',
                    'content' => 'required|string',
                    'tag' => 'required|string',
                    'read' => 'required|integer',
                    'highlight' => 'required|string|in:active, inactive',
                ]);

                $slug = Str::slug($validatedData['title']);
                $originalSlug = $slug;
                $counter = 1;
                while (Pelatihan::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $validatedData['slug'] = $slug;
                $validatedData['image'] = $tmpFile->folder . '/' . $tmpFile->file;
                $validatedData['user_id'] = Auth::id();
                $validatedData['status'] = 'active';

                if ($validatedData['highlight'] === 'active') {
                    Pelatihan::where('highlight', 'active')->update(['highlight' => 'inactive']);
                }

                Pelatihan::create($validatedData);

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('image-law-app');

                return redirect(route('dashboard.pages.pelatihan.index'))->with('success', 'Pelatihan created successfully.');
            } else {
                throw new \Exception('Temporary files not found or empty.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create pelatihan.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $pelatihan = Pelatihan::findOrFail($id);

            if ($pelatihan->image) {
                $parts = explode('/', $pelatihan->image);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-image/' . $folder);
            }

            $pelatihan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pelatihan updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update pelatihan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        if (auth()->user()->can('edit pelatihan')) {
            try {
                FilePondHelpers::removeTemporaryImage();

                $pelatihan = Pelatihan::findOrFail($id);

                return view('dashboard.pages.pelatihan.edit', compact('pelatihan'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to find pelatihan');
            }
        } else {
            return abort(403);
        }
    }

    public function update($id)
    {
        try {
            $pelatihan = Pelatihan::findOrFail($id);
            $sessionFile = Session::get('image-law-app');

            if (!empty($sessionFile)) {
                $tmpFile = TemporaryImage::where('folder', $sessionFile)->first();
                Storage::move('post/tmp-filepond-image/' . $tmpFile->folder . '/' . $tmpFile->file, 'filepond-image/' . $tmpFile->folder . '/' . $tmpFile->file);
            }

            $validatedData = request()->validate([
                'title' => 'required|string',
                'overview' => 'required|string',
                'content' => 'required|string',
                'tag' => 'required|string',
                'status' => 'required|string|in:active,inactive',
                'read' => 'required|integer',
                'highlight' => 'required|string|in:active, inactive',
            ]);

            $slug = Str::slug($validatedData['title']);
            $validatedData['slug'] = $slug;

            if ($validatedData['highlight'] === 'active') {
                Pelatihan::where('highlight', 'active')->update(['highlight' => 'inactive']);
            }

            if (isset($tmpFile)) {
                $validatedData['image'] = $tmpFile->folder . '/' . $tmpFile->file;
                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('image-law-app');
            }

            $pelatihan->update($validatedData);

            return redirect(route('dashboard.pages.pelatihan.index'))->with('success', 'Pelatihan updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update pelatihan');
        }
    }

    public function data()
    {
        $pelatihans = Pelatihan::orderBy('id', 'desc')->get();

        return DataTables::of($pelatihans)
            ->addIndexColumn()
            ->addColumn('title', function ($row) {
                return $row->title;
            })
            ->addColumn('tag', function ($row) {
                $tags = explode(',', $row->tag);

                $tagLabels = '';
                foreach ($tags as $tag) {
                    $tagLabels .= "<label class='badge badge-primary mb-2'>{$tag}</label> ";
                }

                return $tagLabels;
            })
            ->addColumn('overview', function ($row) {
                return $row->overview;
            })
            ->addColumn('status', function ($row) {
                $statusLabel = $row->status == 'active' ? '<label class="badge badge-info mb-0">Active</label>' : '<label class="badge badge-secondary mb-0">Inactive</label>';
                return $statusLabel;
            })
            ->addColumn('highlight', function ($row) {
                $highlightLabel = $row->highlight == 'active' ? '<label class="badge badge-info mb-0">Active</label>' : '<label class="badge badge-secondary mb-0">Inactive</label>';
                return $highlightLabel;
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit pelatihan') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus pelatihan') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <a href="' . route('dashboard.pages.pelatihan.edit', ['pelatihan' => $row->id]) . '"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Pelatihan" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </a>
                        <button onclick="destroyPelatihan(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Pelatihan" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['tag', 'status', 'highlight', 'action'])
            ->make(true);
    }
}
