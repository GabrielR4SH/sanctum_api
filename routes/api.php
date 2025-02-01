<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('userprofile', [AuthController::class, 'userProfile']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('userResource', [AuthController::class,'userResource']);
        
    });
});

