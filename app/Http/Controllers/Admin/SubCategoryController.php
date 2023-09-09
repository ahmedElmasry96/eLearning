<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\Upload;
use Exception;

class SubCategoryController extends Controller
{
    use Upload;
    
    public function __construct()
    {
        $this->middleware('can:show subCategories', ['only' => ['index']]);
        $this->middleware('can:create subCategory', ['only' => ['create', 'store']]);
        $this->middleware('can:edit subCategory', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete subCategory', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::all();
        return view('dashboard.subCategories.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.subCategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        try {
            $subCat = SubCategory::create([
                'name' => $request->name,
            ]);
            $subCat->categories()->attach($request->categories);
            if ($request->image) {
                $image = $this->uploadImage($request->image, 'subCategories/' . $subCat->id);
                SubCategory::findOrFail($subCat->id)->update([
                    'image' => $image,
                ]);
            }
            session()->flash('add');
            return redirect(route('subCategories.index'));
        } catch (Exception $e) {
            return $e->getMessage();
            session()->flash($e->getMessage());
            return redirect(route('subCategories.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.subCategories.edit', compact('subCategory', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSubCategoryRequest $request, string $id)
    {
        try {
            $subCat = SubCategory::findOrFail($id);
            $subCat->update([
                'name' => $request->name,
            ]);
            $subCat->categories()->sync($request->categories);
            if ($request->image) {
                $this->removeImage($subCat->image);
                $image = $this->uploadImage($request->image, 'subCategories/' . $subCat->id);
                $subCat->update([
                    'image' => $image,
                ]);
            }
    
            session()->flash('add');
            return redirect(route('subCategories.index'));
        } catch (Exception $e) {
            return $e->getMessage();
            session()->flash($e->getMessage());
            return redirect(route('subCategories.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->delete();
            session()->flash('delete');
            return redirect(route('subCategories.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('subCategories.index'));
        }
    }
}
