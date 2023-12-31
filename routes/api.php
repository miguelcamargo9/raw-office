<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth.apikey')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'edit']);
});

Route::middleware('auth.apikey')->prefix('v1')->group(function () {
    Route::resource('users', UserServiceController::class)->except(['create', 'edit']);
});
