<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('dashboard.user.index', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z0-9,\.\s\-\(\)\']+$/',
                'email' => 'required|email|unique:users,email',
                'access' => 'required|string|regex:/^[a-zA-Z0-9,\.\s\-\(\)]+$/',
                'status' => 'required|string|in:active,inactive',
                'gender' => 'required|string|in:laki-laki,perempuan',
                'password' => 'required|string',
                'confirm_password' => 'required|same:password|string',
                'email_verified_at' => now(),
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            User::create($validatedData)->assignRole($validatedData['access']);

            return redirect()->back()->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user.');
        }
    }

    public function show() {}

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $roles = Role::all();

            return response()->json([
                'success' => true,
                'message' => 'User find successfully.',
                'user' => $user,
                'role' => $roles,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update($id)
    {
        try {
            $user = User::findOrFail($id);

            $validatedData = request()->validate([
                'name' => 'required|string|regex:/^[a-zA-Z0-9,\.\s\-\(\)\']+$/',
                'email' => 'required|email',
                'gender' => 'required|string|in:laki-laki,perempuan',
                Rule::unique('users', 'email')->ignore($id),
                'access' => 'required|string|regex:/^[a-zA-Z0-9,\.\s\-\(\)]+$/',
                'status' => 'required|string|in:active,inactive',
            ]);

            if (request()->filled('password_edit')) {
                $validatedPassword = request()->validate([
                    'password_edit' => 'required|string',
                    'confirm_password_edit' => 'required|same:password_edit|string',
                ]);

                $user->password = bcrypt($validatedPassword['password_edit']);
            }

            $user->update($validatedData);
            $user->syncRoles($validatedData['access']);

            return redirect()->back()->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user.');
        }
    }

    public function data()
    {
        $users = User::select(['*'])
            ->orderBy('users.id', 'desc')
            ->get();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('gender', function ($row) {
                return $row->gender;
            })
            ->addColumn('access', function ($row) {
                return $row->access;
            })
            ->addColumn('status', function ($row) {
                $statusLabel = $row->status == 'active' ? '<label class="badge badge-info mb-0">Active</label>' : '<label class="badge badge-secondary mb-0">Inactive</label>';
                return $statusLabel;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                    <div class="d-flex">
                        <button 
                            onclick="updateUser(' . $row->id . ')"
                            type="button" 
                            class="btn btn-inverse-warning p-2 mr-1"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Edit Pengguna" 
                            data-bs-custom-class="tooltip-dark"
                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                <i class="ti-pencil mx-1 my-2"></i>
                        </button>
                        <button 
                            onclick="destroyUser(' . $row->id . ')"
                            type="button" 
                            class="btn btn-inverse-danger p-2"
                            data-bs-tooltip="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="Hapus Pengguna" 
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
