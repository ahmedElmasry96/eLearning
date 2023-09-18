<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseTranslation;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses()
    {
        $courses = Course::all();
        return view('website.courses', compact('courses'));
    }

    public function search(Request $request) {
        if ($request->search) {
            $courses = CourseTranslation::join('courses', 'courses.id', '=', 'course_translations.course_id')->join('instructors', 'instructors.id', '=', 'courses.instructor_id')->where('course_translations.name', 'LIKE', '%'.$request->search.'%')->select(['courses.id', 'course_translations.name', 'course_translations.description', 'courses.image', 'price', 'students_number', 'hours', 'instructors.name as instructorName'])->get();
            return response()->json($courses);
        } else {
            $courses = CourseTranslation::join('courses', 'courses.id', '=', 'course_translations.course_id')->join('instructors', 'instructors.id', '=', 'courses.instructor_id')->select(['courses.id', 'course_translations.name', 'course_translations.description', 'courses.image', 'price', 'students_number', 'hours', 'instructors.name as instructorName'])->get();
            return response()->json($courses);
        }
    }

    public function details($id) {
        $course = Course::findOrFail($id);
        return view('website.courseDetails', compact('course'));
    }

    public function categoryCourses($id)
    {
        $category = Category::findOrFail($id);
        $courses = Course::where('category_id', $id)->get();
        return view('website.categoryCourses', compact('courses', 'category'));
    }

    public function categoryCoursesSearch(Request $request, $id) {
        if ($request->search) {
            $courses = CourseTranslation::join('courses', 'courses.id', '=', 'course_translations.course_id')->join('instructors', 'instructors.id', '=', 'courses.instructor_id')->where('course_translations.name', 'LIKE', '%'.$request->search.'%')->where('courses.category_id', $id)->select(['courses.id', 'course_translations.name', 'course_translations.description', 'courses.image', 'price', 'students_number', 'hours', 'instructors.name as instructorName'])->get();
            return response()->json($courses);
        } else {
            $courses = CourseTranslation::join('courses', 'courses.id', '=', 'course_translations.course_id')->join('instructors', 'instructors.id', '=', 'courses.instructor_id')->where('courses.category_id', $id)->select(['courses.id', 'course_translations.name', 'course_translations.description', 'courses.image', 'price', 'students_number', 'hours', 'instructors.name as instructorName'])->get();
            return response()->json($courses);
        }
    }
}
