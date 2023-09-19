<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function instructors()
    {
        $instructors = Instructor::all();
        return view('website.instructors', compact('instructors'));
    }

    public function details($id)
    {
        $instructor = Instructor::findOrFail($id);
        return view('website.instructorDetails', compact('instructor'));
    }
}
