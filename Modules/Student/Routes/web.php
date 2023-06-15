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

Route::prefix('student')->group(function () {
    Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');
    Route::get('/course/list', 'StudentController@courseList')->name('student.course');
    Route::get('/course/class-list/{course_id}', 'StudentController@courseWiseClassList')->name('student.course.class');
    Route::get('/', 'StudentController@index');
});
