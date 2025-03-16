<?php

use App\Http\Controllers\Api\CompanyController;

Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/{company}', [CompanyController::class, 'show']);
    Route::post('/', [CompanyController::class, 'store']);
    Route::put('/{company}', [CompanyController::class, 'update']);
    Route::delete('/{company}', [CompanyController::class, 'destroy']);
});
