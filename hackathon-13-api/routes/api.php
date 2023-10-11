<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'authenticated'])->name('user.authenticated');
});

Route::middleware(['role.administrator'])->group(function () {
    Route::apiResource('users', UserController::class);
});

Route::middleware(['role.employee'])->group(function () {
    
});

Route::middleware(['role.partner'])->group(function () {
    
});

Route::middleware(['role.guest'])->group(function () {
    
});
