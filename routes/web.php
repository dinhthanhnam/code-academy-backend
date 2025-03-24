<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
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
})->middleware(['web']);

Route::group(['prefix' => 'api'], function () {
    Route::get('/personal_role', [AuthController::class, 'personal_role']);
    Route::get('/personal_course_classes', [StudentController::class, 'personal_course_classes']);
});
