<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
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
}
