<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Models\Admin;
use App\Traits\Upload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    use Upload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            if ($request->image) {
                $image = $this->uploadImage($request->image, 'admins/' . $admin->id);
                Admin::findOrFail($admin->id)->update([
                    'image' => $image,
                ]);
            }
            $admin->assignRole($request->role);
            DB::commit();
            session()->flash('add');
            return redirect(route('admins.index'));
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            session()->flash('error');
            return redirect(route('admins.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('dashboard.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::findOrFail($id);
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
    
            if ($request->password) {
                $admin->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            if ($request->image) {
                $image = $this->uploadImage($request->image, 'admins/' . $admin->id);
                $admin->update([
                    'image' => $image,
                ]);
            }
            $admin->syncRoles($request->role);
            DB::commit();
            session()->flash('edit');
            return redirect(route('admins.index'));
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error');
            return redirect(route('admins.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();
            session()->flash('delete');
            return redirect(route('admins.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('admins.index'));
        }
    }
}
