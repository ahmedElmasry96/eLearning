<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::group(['middleware' => 'auth:admin', 'prefix' => 'dashboard'], function() {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('users', UserController::class);
            Route::resource('admins', AdminController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('instructors', InstructorController::class);
            Route::resource('courses', CourseController::class);
            Route::resource('videos', VideoController::class);
            Route::resource('permissions', PermissionController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('sliders', SliderController::class);
            Route::resource('services', ServiceController::class);
            Route::resource('about', AboutController::class);
        });
        require __DIR__.'/auth.php';
    });

