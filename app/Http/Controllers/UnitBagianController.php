<?php

namespace App\Http\Controllers;

use App\Models\UnitBagian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UnitBagianController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat unitbagian')) {
            return view('dashboard.pages.unit-bagian.index');
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
                'content' => 'required|string',
            ]);

            UnitBagian::create($validatedData);

            return redirect()->back()->with('success', 'Unit bagian created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $unitBagian = UnitBagian::findOrFail($id);

            $unitBagian->delete();

            return response()->json([
                'success' => true,
                'message' => 'Unit bagian deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete unit bagian.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $unitBagian = UnitBagian::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Unit bagian find successfully.',
                'data' => $unitBagian,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find unit bagian.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|string',
                'content' => 'required|string',
            ]);

            $unitBagian = UnitBagian::findOrFail($id);

            $unitBagian->update($validateData);

            return redirect()->back()->with('success', 'Unit bagian updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update unit bagian.');
        }
    }

    public function data()
    {
        $unitBagian = UnitBagian::orderBy('id')->get();

        return DataTables::of($unitBagian)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit unitbagian') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus unitbagian') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updateUnitBagian(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Unit Bagian" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyUnitBagian(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Unit Bagian" 
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
