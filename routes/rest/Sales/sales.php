<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('sales', [SalesController::class, 'index']);
Route::get('sales/{id}', [SalesController::class, 'show']);
Route::post('sales', [SalesController::class, 'store']);