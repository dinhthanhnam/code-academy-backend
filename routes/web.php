<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CRUDController\CourseController as CourseCRUDController;
use App\Http\Controllers\CRUDController\CourseClassController as CourseClassCRUDController;
use App\Http\Controllers\CRUDController\LecturerController as LecturerCRUDController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, "login"]);
Route::post('/register', [AuthController::class, "register"]);
Route::post('/logout', [AuthController::class, "logout"])
    ->middleware('auth');

Route::get('/auth/check', function (Request $request) {
    if (Auth::check()) {
        return response()->json([
            'authenticated' => true,
        ]);
    }

    return response()->json([
        'authenticated' => false
    ], 401);
})->middleware('web');

Route::group(['prefix' => 'api'], function () {
    Route::get('/personal_role', [AuthController::class, 'personal_role']);
    Route::get('/personal_course_classes', [StudentController::class, 'personal_course_classes']);
    Route::get('/lecturer_course_classes', [LecturerController::class, 'lecturer_course_classes']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::apiResource('course', CourseCRUDController::class);
    Route::apiResource('course-class', CourseClassCRUDController::class);
    Route::apiResource('lecturer', LecturerCRUDController::class);
});

Route::group(['prefix' => 'course' , 'middleware' => 'admin'], function () {
    Route::get('course-classes', [CourseController::class, 'get_course_classes_by_course_id']);
});

Route::group(['prefix' => 'lecturer', 'middleware' => 'admin'], function () {
    Route::get('course-classes', [LecturerController::class, 'get_course_classes_by_lecturer_id']);
});

Route::group(['prefix' => 'option'], function () {
    Route::get('regular-class', [OptionController::class, 'regular_class']);
    Route::get('course', [OptionController::class, 'course']);
    Route::get('lecturer', [OptionController::class, 'lecturer']);
});
