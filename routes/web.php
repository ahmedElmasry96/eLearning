<?php

use App\Http\Controllers\Website\AboutController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\CourseController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\InstructorController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::get('/', [HomeController::class, 'index'])->name('website.index');
        Route::get('/about', [AboutController::class, 'about'])->name('website.about');

        Route::group(['prefix' => 'courses'], function() {
            Route::get('/', [CourseController::class, 'courses'])->name('website.courses');
            Route::get('/search', [CourseController::class, 'search'])->name('website.courses.search');    
            Route::get('/{id}/details', [CourseController::class, 'details'])->name('website.course.details');
        });

        Route::get('/category/{id}/courses', [CourseController::class, 'categoryCourses'])->name('website.categoryCourses');
        Route::get('/categoryCourses/{id}/search', [CourseController::class, 'categoryCoursesSearch'])->name('website.categoryCourses.search');

        Route::group(['prefix' => 'instructors'], function() {
            Route::get('/', [InstructorController::class, 'instructors'])->name('website.instructors');
            Route::get('/{id}/details', [InstructorController::class, 'details'])->name('website.instructor.details');
        });

        Route::get('/contact', [ContactController::class, 'contact'])->name('website.contact');
        Route::post('/send-mail', [ContactController::class, 'sendMail'])->name('website.contact.sendEmail');
    });


