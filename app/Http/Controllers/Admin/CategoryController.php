<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCategoryRequest;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create([
                'name' => $request->name,
            ]);
            session()->flash('add');
            return redirect(route('categories.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('categories.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);
    
            session()->flash('edit');
            return redirect(route('categories.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('categories.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            session()->flash('delete');
            return redirect(route('categories.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('categories.index'));
        }
    }
}
