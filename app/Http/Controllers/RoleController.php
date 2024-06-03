<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller

{
    public function index(Request $request)
    {
        $query = Role::query();
        $roles = $query->get();
        if ($request->has('trashed') && $request->trashed == true) {
            $roles = $query->onlyTrashed()->get();
        }
        return view('modules.roles.index', compact('roles'));
    }


    public function showPermissions($id)
    {
        $roles = Role::with('permissions')->where('id', $id)->first();
        return view('modules.permissions.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('modules.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $request->name]);
            $role->permissions()->attach($request->permission);
            DB::commit();
            return redirect()->route('role.index')->with('success', 'Role created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to create role. Please try again.');
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $role = Role::with('permissions')->where('id', $id)->first();
        return view('modules.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {

        try {
            DB::beginTransaction();
            $role->name = $request->input('name');
            $role->save();
            $role->permissions()->sync($request->input('permission'));
            DB::commit();
            return redirect()->route('role.index')->with('success', 'Role updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Role Update: ' . $e->getMessage());
            return back()->with('error', 'Failed to update role. Please try again.');
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return back()->with('success', 'Role has been deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to delete role. Please try again.');
        }
    }

    public function rolePermanentDelete($id)
    {
        $role = Role::withTrashed()->findOrFail($id);
        $role->forceDelete();
        return redirect()->route('role.index')->with('success', 'Role permanently deleted.');
    }

    public function restoreRole($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();
        return redirect()->back()->with('success', 'Role restored successfully.');
    }
}
