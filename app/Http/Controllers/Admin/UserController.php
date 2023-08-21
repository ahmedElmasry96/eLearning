<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreUserRequest;
use App\Http\Requests\Dashboard\UpdateUserRequest;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'age' => $request->age,
            ]);
            session()->flash('add');
            return redirect(route('users.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('users.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
            ]);
    
            if ($request->password) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            session()->flash('edit');
            return redirect(route('users.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('users.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            session()->flash('delete');
            return redirect(route('users.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('users.index'));
        }
    }
}
