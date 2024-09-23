<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Authentication
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
Route::get('/getall-auth', [App\Http\Controllers\Auth\GetAllController::class, 'getAll'])->name('getAll');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
