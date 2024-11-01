<?php

namespace App\Http\Controllers;

use App\Helpers\FilePondHelpers;
use App\Models\Blog;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat blog')) {
            return view('dashboard.blog.index');
        } else {
            return abort(403);
        }
    }

    public function create()
    {
        if (auth()->user()->can('tambah blog')) {
            FilePondHelpers::removeTemporaryImage();

            return view('dashboard.blog.add');
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
                ]);

                $slug = Str::slug($validatedData['title']);
                $originalSlug = $slug;
                $counter = 1;
                while (Blog::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $validatedData['slug'] = $slug;
                $validatedData['image'] = $tmpFile->folder . '/' . $tmpFile->file;
                $validatedData['user_id'] = Auth::id();
                $validatedData['status'] = 'active';

                Blog::create($validatedData);

                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('image-law-app');

                return redirect(route('dashboard.blog.index'))->with('success', 'Blog created successfully.');
            } else {
                throw new \Exception('Temporary files not found or empty.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create blog.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            if ($blog->image) {
                $parts = explode('/', $blog->image);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-image/' . $folder);
            }

            $blog->delete();

            return response()->json([
                'success' => true,
                'message' => 'Blog updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update blog',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        if (auth()->user()->can('edit blog')) {
            try {
                FilePondHelpers::removeTemporaryImage();

                $blog = Blog::findOrFail($id);

                return view('dashboard.blog.edit', compact('blog'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to find blog');
            }
        } else {
            return abort(403);
        }
    }

    public function update($id)
    {
        try {
            $blog = Blog::findOrFail($id);
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
            ]);

            $slug = Str::slug($validatedData['title']);
            $validatedData['slug'] = $slug;

            if (isset($tmpFile)) {
                $validatedData['image'] = $tmpFile->folder . '/' . $tmpFile->file;
                Storage::deleteDirectory('post/tmp-filepond-image/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('image-law-app');
            }

            $blog->update($validatedData);

            return redirect(route('dashboard.blog.index'))->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update blog');
        }
    }

    public function data()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();

        return DataTables::of($blogs)
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
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit blog') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus blog') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <a href="' . route('dashboard.blog.edit', ['blog' => $row->id]) . '"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Blog" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </a>
                        <button onclick="destroyBlog(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Blog" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['tag', 'status', 'action'])
            ->make(true);
    }
}
