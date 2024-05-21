<?php

use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);

Route::get('users', [UserAuthController::class, 'index']);