<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCourseRequest;
use App\Http\Requests\Dashboard\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Traits\Upload;
use Exception;

class CourseController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware('can:show courses', ['only' => ['index']]);
        $this->middleware('can:create course', ['only' => ['create', 'store']]);
        $this->middleware('can:edit course', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete course', ['only' => ['destroy']]);
    }

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
        $categories = Category::all();
        $instructors = Instructor::all();
        return view('dashboard.courses.create', compact('categories', 'instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            $course = Course::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category,
                'instructor_id' => $request->instructor,
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
            return $e->getMessage();
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
        $categories = category::all();
        $instructors = Instructor::all();
        return view('dashboard.courses.edit', compact('course', 'categories', 'instructors'));
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
                'category_id' => $request->category,
                'instructor_id' => $request->instructor,
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
