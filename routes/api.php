<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;



Route::prefix('v1')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'message' => 'Hello, world!',
            'status' => 200
        ]);
    });
    require __DIR__ . '/api/auth.php';
    require __DIR__ . '/api/user.php';
});
