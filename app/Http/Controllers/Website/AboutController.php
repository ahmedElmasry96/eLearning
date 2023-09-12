<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function about() {
        $about = About::first();
        return view('website.about', compact('about'));
    }
}
