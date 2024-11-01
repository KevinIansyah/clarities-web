<?php

namespace App\Http\Controllers;

use App\Models\FasilitasLab;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FasilitasLabController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat fasilitaslab')) {
            return view('dashboard.lab.fasilitas.index');
        } else {
            return abort(403);
        }
    }

    public function create() {}

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'status' => 'required|string|in:active,inactive',
            ]);

            FasilitasLab::create($validatedData);

            return redirect()->back()->with('success', 'Ruangan lab created successfully..');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create ruangan lab.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $fasilitasLab = FasilitasLab::findOrFail($id);

            $fasilitasLab->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ruangan lab deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete ruangan lab.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $fasilitasLab = FasilitasLab::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Ruangan lab find successfully.',
                'data' => $fasilitasLab,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find ruangan lab.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|string',
                'status' => 'required|string|in:active,inactive',
            ]);

            $fasilitasLab = FasilitasLab::findOrFail($id);

            $fasilitasLab->update($validateData);

            return redirect()->back()->with('success', 'Ruangan lab updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update ruangan lab.');
        }
    }

    public function data()
    {
        $fasilitasLab = FasilitasLab::orderBy('id')->get();

        return DataTables::of($fasilitasLab)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('status', function ($row) {
                $statusLabel = $row->status == 'active' ? '<label class="badge badge-info mb-0">Active</label>' : '<label class="badge badge-secondary mb-0">Inactive</label>';
                return $statusLabel;
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit fasilitaslab') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus fasilitaslab') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updateFasilitasLab(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Fasilitas Lab" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyFasilitasLab(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Fasilitas Lab" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['status', 'action'])
            ->make(true);
    }
}
