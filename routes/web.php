<?php

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
            'user' => Auth::user()
        ]);
    }

    return response()->json([
        'authenticated' => false
    ], 401);
})->middleware(['web', 'auth']);
