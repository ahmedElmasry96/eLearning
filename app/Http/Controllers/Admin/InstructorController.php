<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreInstructorRequest;
use App\Http\Requests\Dashboard\UpdateInstructorRequest;
use App\Models\Instructor;
use App\Models\SubCategory;
use App\Traits\Upload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware('can:show instructors', ['only' => ['index']]);
        $this->middleware('can:create instructor', ['only' => ['create', 'store']]);
        $this->middleware('can:edit instructor', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete instructor', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::all();
        return view('dashboard.instructors.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subCategories = SubCategory::all();
        return view('dashboard.instructors.create', compact('subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request)
    {
        try {
            DB::beginTransaction();
            $instructor = Instructor::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'age' => $request->age,
            ]);
            $instructor->subCategories()->attach($request->subCategories);
            $image = $this->uploadImage($request->image, 'instructors/' . $instructor->id);
            Instructor::findOrFail($instructor->id)->update([
                'image' => $image,
            ]);
            DB::commit();
            session()->flash('add');
            return redirect(route('instructors.index'));
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error');
            return redirect(route('instructors.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $instructor = Instructor::findOrFail($id);
        $subCategories = SubCategory::all();
        return view('dashboard.instructors.edit', compact('instructor', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $instructor = Instructor::findOrFail($id);
            $instructor->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
            ]);
    
            if ($request->password) {
                $instructor->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            if ($request->image) {
                $this->removeImage($instructor->image);
                $image = $this->uploadImage($request->image, 'instructors/' . $instructor->id);
                Instructor::findOrFail($instructor->id)->update([
                    'image' => $image,
                ]);
            }
            $instructor->subCategories()->sync($request->subCategories);

            DB::commit();
            session()->flash('edit');
            return redirect(route('instructors.index'));
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error');
            return redirect(route('instructors.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $instructor = Instructor::findOrFail($id);
            $path = 'instructors/' . $instructor->id;
            $this->removeImageFolder($path);
            $instructor->delete();
            session()->flash('delete');
            return redirect(route('instructors.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('instructors.index'));
        }
    }
}
