<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCourseRequest;
use App\Http\Requests\Dashboard\StoreVideoRequest;
use App\Http\Requests\Dashboard\UpdateCourseRequest;
use App\Models\Course;
use App\Models\SubCategory;
use App\Traits\Upload;
use Exception;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use Upload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('dashboard.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subCategories = SubCategory::all();
        return view('dashboard.courses.create', compact('subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        try {
            $course = Course::create([
                'name' => $request->name,
                'description' => $request->description,
                'sub_category_id' => $request->subCategory,
            ]);

            if ($request->image) {
                $image = $this->uploadImage($request->image, 'courses/' . $course->id);
                Course::findOrFail($course->id)->update([
                    'image' => $image,
                ]);
            }
            session()->flash('add');
            return redirect(route('courses.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('courses.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        $subCategories = SubCategory::all();
        return view('dashboard.courses.edit', compact('course', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->update([
                'name' => $request->name,
                'description' => $request->description,
                'sub_category_id' => $request->subCategory,
            ]);

            if ($request->image) {
                $this->removeImage($course->image);
                $image = $this->uploadImage($request->image, 'courses/' . $course->id);
                $course->update([
                    'image' => $image,
                ]);
            }
            session()->flash('edit');
            return redirect(route('courses.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('courses.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $course = Course::findOrFail($id);
            $path = 'courses/' . $course->id;
            $this->removeImageFolder($path);
            $course->delete();
            session()->flash('delete');
            return redirect(route('courses.index'));
        } catch (Exception $e) {
            session()->flash('error');
            return redirect(route('courses.index'));
        }
    }
}
