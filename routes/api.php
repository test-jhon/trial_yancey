<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CarController;

// Expose only APIs which are required but the controllers are already CRUD
Route::apiResource('manufacturers', ManufacturerController::class)->only(['index','store','destroy']);
Route::apiResource('types', TypeController::class)->only(['index','store','destroy']);
Route::apiResource('colors', ColorController::class)->only(['index','store','destroy']);
// Route::apiResource('cars', CarController::class)->only(['index','store','destroy']);
Route::apiResource('cars', CarController::class);
