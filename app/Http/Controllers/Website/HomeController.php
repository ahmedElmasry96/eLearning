<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Service;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $services = Service::all();
        $about = About::first();
        $categories = Category::limit(4)->get();
        $courses = Course::all();
        $instructors = Instructor::all();
        return view('website.index', compact('sliders', 'services', 'about', 'categories', 'courses', 'instructors'));
    }
}
