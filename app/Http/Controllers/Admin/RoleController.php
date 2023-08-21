<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreRoleRequest;
use App\Http\Requests\Dashboard\UpdateRoleRequest;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show roles', ['only' => ['index']]);
        $this->middleware('can:create role', ['only' => ['create', 'store']]);
        $this->middleware('can:edit role', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'admin',
            ]);
            $role->syncPermissions($request->permissions);
            session()->flash('add');
            return redirect(route('roles.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('roles.index'));
        }   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        return view('dashboard.roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->update([
                'name' => $request->name,
            ]);
            $role->syncPermissions($request->permissions);
            session()->flash('add');
            return redirect(route('roles.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('roles.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->revokePermissionTo($role->permissions);
            $role->delete();
            session()->flash('delete');
            return redirect(route('roles.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('roles.index'));
        }
    }
}
