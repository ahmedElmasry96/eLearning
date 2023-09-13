<?php

use App\Http\Controllers\Website\AboutController;
use App\Http\Controllers\Website\CourseController;
use App\Http\Controllers\Website\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::get('/', [HomeController::class, 'index'])->name('website.index');
        Route::get('/about', [AboutController::class, 'about'])->name('website.about');
        Route::get('/courses', [CourseController::class, 'courses'])->name('website.courses');
        Route::get('/courses/search', [CourseController::class, 'search'])->name('website.courses.search');
    });


