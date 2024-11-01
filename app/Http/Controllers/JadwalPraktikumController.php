<?php

namespace App\Http\Controllers;

use App\Models\JadwalPraktikum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JadwalPraktikumController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat jadwalpraktikum')) {
            return view('dashboard.praktikum.jadwal.index');
        } else {
            return abort(403);
        }
    }

    public function create()
    {
        if (auth()->user()->can('tambah jadwalpraktikum')) {
            return view('dashboard.praktikum.jadwal.add');
        } else {
            return abort(403);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'instruktur' => 'required|string',
                'mata_kuliah' => 'required|string',
                'materi' => 'required|string',
                'kelas' => 'required|string',
                'semester' => 'required|string',
                'date_start' => 'required|string',
                'date_end' => 'required|string',
                'time_start' => 'required|string',
                'time_end' => 'required|string',
            ]);

            $validatedData['user_id'] = Auth::id();

            JadwalPraktikum::create($validatedData);

            return redirect(route('dashboard.praktikum.jadwal.index'))->with('success', 'Jadwal praktikum successfully added.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create jadwal praktikum.');
        }
    }

    public function show($id)
    {
        try {
            $jadwalPraktikum = JadwalPraktikum::with(['user'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal praktikum find successfully.',
                'data' => $jadwalPraktikum,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find jadwal praktikum.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jadwalPraktikum = JadwalPraktikum::findOrFail($id);

            $jadwalPraktikum->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal praktikum deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete jadwal praktikum.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        if (auth()->user()->can('edit jadwalpraktikum')) {
            try {
                $jadwalPraktikum = JadwalPraktikum::with(['user'])->findOrFail($id);

                return view('dashboard.praktikum.jadwal.edit', compact('jadwalPraktikum'));
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
            $jadwalPraktikum = JadwalPraktikum::findOrFail($id);

            $validatedData = request()->validate([
                'instruktur' => 'required|string',
                'mata_kuliah' => 'required|string',
                'materi' => 'required|string',
                'kelas' => 'required|string',
                'date_start' => 'required|string',
                'date_end' => 'required|string',
                'time_start' => 'required|string',
                'time_end' => 'required|string',
            ]);

            $jadwalPraktikum->update($validatedData);

            return redirect(route('dashboard.praktikum.jadwal.index'))->with('success', 'Jadwal praktikum successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update jadwal praktikum');
        }
    }

    public function data()
    {
        $jadwalPraktikum = JadwalPraktikum::with(['user'])
            ->orderBy('id', 'desc')
            ->get();

        return DataTables::of($jadwalPraktikum)
            ->addIndexColumn()
            ->addColumn('instruktur', function ($row) {
                return $row->instruktur;
            })
            ->addColumn('materi', function ($row) {
                return $row->materi;
            })
            ->addColumn('mata_kuliah', function ($row) {
                return $row->mata_kuliah;
            })
            ->addColumn('kelas', function ($row) {
                return $row->kelas;
            })
            ->addColumn('date', function ($row) {
                if ($row->date_start == $row->date_end) {
                    return Carbon::parse($row->date_start)->translatedFormat('d F Y');
                } else {
                    return Carbon::parse($row->date_start)->translatedFormat('d F Y') . ' - ' .  Carbon::parse($row->date_end)->translatedFormat('d F Y');
                }
            })
            ->addColumn('time', function ($row) {
                return $row->time_start . ' - ' . $row->time_end;
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit jadwalpraktikum') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus jadwalpraktikum') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="showJadwalPraktikum(' . $row->id . ')"
                            type="button" 
                            class="btn btn-inverse-info p-2 mr-1"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Detail Jadwal Praktikum" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-eye mx-1 my-2"></i>
                        </button>
                        <a href="' . route('dashboard.praktikum.jadwal.edit', ['jadwal' => $row->id]) . '"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Jadwal Praktikum" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </a>
                        <button onclick="destroyJadwalPraktikum(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Jadwal Praktikum" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['action'])
            ->make(true);
    }
}
