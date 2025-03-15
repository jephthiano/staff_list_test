<?php

use App\Http\Controllers\StaffController;

Route::prefix('staff')->group(function () {
    Route::get('/', [StaffController::class, 'index']);
    Route::get('/{staff}', [StaffController::class, 'show']);
    Route::post('/', [StaffController::class, 'store']);
    Route::put('/{staff}', [StaffController::class, 'update']);
    Route::delete('/{staff}', [StaffController::class, 'destroy']);
});
