<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VisiMisiController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('lihat visimisi')) {
            return view('dashboard.pages.visi-misi.index');
        } else {
            return abort(403);
        }
    }

    public function create() {}

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'type' => 'required|string|in:visi,misi',
                'content' => 'required|string',
            ]);

            VisiMisi::create($validatedData);

            return redirect()->back()->with('success', 'Visi misi created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create visi misi.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $visiMisi = VisiMisi::findOrFail($id);

            $visiMisi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Visi misi deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete visi misi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $visiMisi = VisiMisi::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Visi misi find successfully.',
                'data' => $visiMisi,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find visi misi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'type' => 'required|string|in:visi,misi',
                'content' => 'required|string',
            ]);

            $visiMisi = VisiMisi::findOrFail($id);

            $visiMisi->update($validateData);

            return redirect()->back()->with('success', 'Visi misi updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update visi misi.');
        }
    }

    public function data()
    {
        $visiMisi = VisiMisi::orderBy('id')->get();

        return DataTables::of($visiMisi)
            ->addIndexColumn()
            ->addColumn('content', function ($row) {
                return $row->content;
            })
            ->addColumn('type', function ($row) {
                $typeLabel = $row->type == 'visi' ? '<label class="badge badge-info mb-0">Visi</label>' : '<label class="badge badge-primary mb-0">Misi</label>';
                return $typeLabel;
            })
            ->addColumn('action', function ($row) {
                $visionEdit = auth()->user()->can('edit visimisi') ? 'd-block' : 'd-none';
                $visionDelete = auth()->user()->can('hapus visimisi') ? 'd-block' : 'd-none';

                $actionBtn = '
                    <div class="d-flex">
                        <button onclick="updateVisiMisi(' . $row->id . ')"
                           class="' . $visionEdit . ' btn btn-inverse-warning p-2 mr-1"
                           data-bs-tooltip="tooltip" 
                           data-bs-placement="top" 
                           data-bs-title="Edit Visi Misi" 
                           data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button onclick="destroyVisiMisi(' . $row->id . ')"
                            type="button" 
                            class="' . $visionDelete . ' btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Visi Misi" 
                            data-bs-custom-class="tooltip-dark">
                                <i class="ti-trash mx-1 my-2"></i>
                        </button>
                    </div>
                ';
                return $actionBtn;
            })

            ->rawColumns(['type', 'action'])
            ->make(true);
    }
}
