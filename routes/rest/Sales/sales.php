<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('sales', [SalesController::class, 'index']);
Route::post('sales', [SalesController::class, 'store']);