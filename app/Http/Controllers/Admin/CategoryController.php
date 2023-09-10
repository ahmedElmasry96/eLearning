<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCategoryRequest;
use App\Http\Requests\Dashboard\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\SubCategory;
use App\Traits\Upload;
use Exception;

class CategoryController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware('can:show categories', ['only' => ['index']]);
        $this->middleware('can:create category', ['only' => ['create', 'store']]);
        $this->middleware('can:edit category', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete category', ['only' => ['destroy']]);
    }

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
            $category = Category::create([
                'name' => $request->name,
            ]);
            if ($request->image) {
                $image = $this->uploadImage($request->image, 'categories/' . $category->id);
                Category::findOrFail($category->id)->update([
                    'image' => $image,
                ]);
            }
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
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);

            if ($request->image) {
                $this->removeImage($category->image);
                $image = $this->uploadImage($request->image, 'categories/' . $category->id);
                $category->update([
                    'image' => $image,
                ]);
            }
    
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
            $subCats_ids = CategorySubCategory::where('category_id', $category->id)->pluck('sub_category_id')->toArray();
            $subCats = SubCategory::all();
            foreach($subCats as $cat) {
                if (in_array($cat->id, $subCats_ids)) {
                    $path = 'subCategories/' . $cat->id;
                    $this->removeImageFolder($path);        
                    SubCategory::findOrFail($cat->id)->delete();
                }
            }
            $path = 'categories/' . $category->id;
            $this->removeImageFolder($path);

            $category->delete();
            session()->flash('delete');
            return redirect(route('categories.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('categories.index'));
        }
    }
}
