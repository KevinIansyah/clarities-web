<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TujuanController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat tujuan')) {
            return view('dashboard.pages.tujuan.index');
        } else {
            return abort(403);
        }
    }

    public function create() {}

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => 'required|string',
            ]);

            Tujuan::create($validatedData);

            return redirect()->back()->with('success', 'Tujuan created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create tujuan.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $tujuan = Tujuan::findOrFail($id);

            $tujuan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tujuan deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete tujuan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $tujuan = Tujuan::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Tujuan find successfully.',
                'data' => $tujuan,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find tujuan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'content' => 'required|string',
            ]);

            $tujuan = Tujuan::findOrFail($id);

            $tujuan->update($validateData);

            return redirect()->back()->with('success', 'Tujuan updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update tujuan.');
        }
    }

    public function data()
    {
        $tujuan = Tujuan::orderBy('id')->get();

        return DataTables::of($tujuan)
            ->addIndexColumn()
            ->addColumn('content', function ($row) {
                return $row->content;
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit tujuan') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus tujuan') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updateTujuan(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Tujuan" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyTujuan(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Tujuan" 
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
