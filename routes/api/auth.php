<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// use App\Http\Controllers\Api\AdminController;

// Route::middleware(['auth:sanctum', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');