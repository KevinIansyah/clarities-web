<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('dashboard.management-role.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|min:3|string|regex:/^[a-zA-Z0-9,\.\s\-\(\)\']+$/',
            ]);

            $validated['name'] = strtolower($validated['name']);

            Role::create($validated);

            return redirect(route('dashboard.management-role.index'))->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create role.');
        }
    }

    public function show(string $id) {}

    public function edit($id)
    {
        try {
            $role = Role::findOrFail($id);
            $permissions = Permission::all();
            $role_permissions = $role->permissions->pluck('name')->toArray();
            return view('dashboard.management-role.edit', compact('role', 'permissions', 'role_permissions'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to find role.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|min:3|string|regex:/^[a-zA-Z0-9,\.\s\-\(\)\']+$/',
            ]);

            $validated['name'] = strtolower($validated['name']);

            $role->update($validated);

            return redirect(route('dashboard.management-role.index'))->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update role.');
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete role.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function givePermission(Request $request, Role $role)
    {
        $permissions = $request->input('permissions', []);

        $role->syncPermissions($permissions);

        return back()->with('success', 'Permissions updated.');
    }

    public function data()
    {
        $role = Role::orderBy('id', 'desc')->get();

        return DataTables::of($role)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                    <div class="d-flex">
                        <a href="' . route('dashboard.management-role.edit', $row->id) . '" 
                            type="button" 
                            class="btn btn-inverse-warning p-2 mr-1" 
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Edit Role" 
                            data-bs-custom-class="tooltip-dark">
                            <i class="ti-pencil mx-1 my-2"></i>
                        </a>
                        <button 
                            onclick="destroyRole(' . $row->id . ')"
                            type="button" 
                            class="btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Role" 
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
