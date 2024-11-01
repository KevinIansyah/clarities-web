<?php

namespace App\Http\Controllers;

use App\Helpers\FilePondHelpers;
use App\Models\KurikulumLab;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KurikulumLabController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat kurikulumlab')) {
            return view('dashboard.lab.kurikulum.index');
        } else {
            return abort(403);
        }
    }

    public function create()
    {
        if (auth()->user()->can('tambah kurikulumlab')) {
            FilePondHelpers::removeTemporaryFile();

            return view('dashboard.lab.kurikulum.add');
        } else {
            return abort(403);
        }
    }

    public function store(Request $request)
    {
        try {
            $sessionFile = Session::get('file-law-app');

            $validatedData = $request->validate([
                'mata_kuliah' => 'required|string',
                'materi' => 'required|string',
                'semester' => 'required|string',
                'tahun_akademik' => 'required|string',
                'link' => 'nullable|string',
            ]);

            $validatedData['user_id'] = Auth::id();

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

            KurikulumLab::create($validatedData);

            return redirect(route('dashboard.lab.kurikulum.index'))->with('success', 'Kurikulum lab successfully added.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create kurikulum lab.');
        }
    }

    public function show($id)
    {
        try {
            $kurikulumLab = KurikulumLab::with(['user'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Kurikulum lab find successfully.',
                'data' => $kurikulumLab,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find kurikulum lab.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kurikulumLab = KurikulumLab::findOrFail($id);

            if ($kurikulumLab->file) {
                $parts = explode('/', $kurikulumLab->file);
                $folder = $parts[count($parts) - 2];
                Storage::deleteDirectory('filepond-file/' . $folder);
            }

            $kurikulumLab->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kurikulum lab deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete kurikulum lab.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        if (auth()->user()->can('edit kurikulumlab')) {
            try {
                FilePondHelpers::removeTemporaryFile();

                $kurikulumLab = KurikulumLab::with(['user'])->findOrFail($id);

                return view('dashboard.lab.kurikulum.edit', compact('kurikulumLab'));
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
        } else {
            return abort(403);
        }
    }

    public function update($id)
    {
        try {
            $kurikulumLab = KurikulumLab::findOrFail($id);
            $sessionFile = Session::get('file-law-app');

            if (!empty($sessionFile)) {
                $tmpFile = TemporaryFile::where('folder', $sessionFile)->first();
                Storage::move('post/tmp-filepond-file/' . $tmpFile->folder . '/' . $tmpFile->file, 'filepond-file/' . $tmpFile->folder . '/' . $tmpFile->file);
            }

            $validatedData = request()->validate([
                'mata_kuliah' => 'required|string',
                'materi' => 'required|string',
                'semester' => 'required|string',
                'tahun_akademik' => 'required|string',
                'link' => 'nullable|string',
            ]);

            if (isset($tmpFile)) {
                $validatedData['file'] = $tmpFile->folder . '/' . $tmpFile->file;
                Storage::deleteDirectory('post/tmp-filepond-file/' . $tmpFile->folder);
                $tmpFile->delete();
                Session::forget('file-law-app');
            }

            $kurikulumLab->update($validatedData);

            return redirect(route('dashboard.lab.kurikulum.index'))->with('success', 'Kurikulum lab successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update kurikulum lab');
        }
    }

    public function data()
    {
        $kurikulumLab = KurikulumLab::with(['user'])
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($kurikulumLab)
            ->addIndexColumn()
            ->addColumn('materi', function ($row) {
                return $row->materi;
            })
            ->addColumn('mata_kuliah', function ($row) {
                return $row->mata_kuliah;
            })
            ->addColumn('semester', function ($row) {
                return $row->semester;
            })
            ->addColumn('tahun_akademik', function ($row) {
                return $row->tahun_akademik;
            })
            ->addColumn('file', function ($row) {
                $file = '<a href="' . asset('storage/filepond-file/' . $row->file) . '" target="_blank" class="btn btn-inverse-info p-2">Dokumen</a>';
                return $row->file ? $file : '-';
            })
            ->addColumn('link', function ($row) {
                return $row->link ? '<a class="btn btn-inverse-info p-2" href="' . $row->link . '" target="_blank">Drive</a>' : '-';
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit kurikulumlab') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus kurikulumlab') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <a href="' . route('dashboard.lab.kurikulum.edit', ['kurikulum' => $row->id]) . '"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Kurikulum Lab" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </a>
                        <button onclick="destroyKurikulumLab(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Kurikulum Lab" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['file', 'link', 'action'])
            ->make(true);
    }
}
