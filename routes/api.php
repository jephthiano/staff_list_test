<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;



Route::prefix('v1')->group(function () {
    require __DIR__ . '/api/company-categories.php';
    // require __DIR__ . '/api/companies.php';
    // require __DIR__ . '/api/staff.php';
    
    // require __DIR__ . '/api/auth.php';
    // Route::get('/', function(){
    //     return response()->json(['message' => 'Welcome to the API'], 200);
    // });
});