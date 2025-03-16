<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {
    require __DIR__ . '/api/company-categories.php';
    require __DIR__ . '/api/companies.php';
    require __DIR__ . '/api/staff.php';
    
    Route::get('/', function(){
        return response()->json(
            ['message' => 'Welcome to the API'], 404);
    });
        // require __DIR__ . '/api/auth.php';
});