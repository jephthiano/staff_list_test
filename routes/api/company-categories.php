<?php

use App\Http\Controllers\CompanyCategoryController;

Route::prefix('company-categories')->group(function () {
    Route::get('/', [CompanyCategoryController::class, 'index']);
    Route::get('/{companyCategory}', [CompanyCategoryController::class, 'show']);
    Route::post('/', [CompanyCategoryController::class, 'store']);
    Route::put('/{companyCategory}', [CompanyCategoryController::class, 'update']);
    Route::delete('/{companyCategory}', [CompanyCategoryController::class, 'destroy']);
});
