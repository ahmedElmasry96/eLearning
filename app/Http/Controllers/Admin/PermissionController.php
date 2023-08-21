<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePermissionRequest;
use App\Http\Requests\Dashboard\UpdatePermissionRequest;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard.permissions.index', compact('permissions')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.permissions.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        try {
            Permission::create([
                'name' => $request->name,
                'guard_name' => 'admin',
            ]);
            session()->flash('add');
            return redirect(route('permissions.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('permissions.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('dashboard.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->update([
                'name' => $request->name,
            ]);
    
            session()->flash('edit');
            return redirect(route('permissions.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('permissions.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();
            session()->flash('delete');
            return redirect(route('permissions.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('permissions.index'));
        }
    }
}
