<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

// use Modules\Course\Http\Controllers\AssignCourseController;
// use Modules\Course\Http\Controllers\ClassController;
// use Modules\Course\Http\Controllers\CourseController;
// use Modules\Course\Http\Controllers\SessionController;



Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['role:super-admin|data-entry']], function () {
        // Route::get('session', [SessionController::class, 'index'])->name('session.index');
        Route::resource('session', SessionController::class);
        Route::resource('class', ClassController::class);
        Route::resource('course', CourseController::class);
        Route::resource('assign-course', AssignCourseController::class);
    });
});
