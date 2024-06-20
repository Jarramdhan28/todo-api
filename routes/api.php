<?php

use App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

// Auth Route
Route::post('register', [Auth\RegisterController::class, '__invoke']);
Route::post('login', [Auth\LoginController::class, '__invoke']);


Route::middleware('auth:sanctum')->group(function (){
    // Logout Route
    Route::get('logout', [Auth\LogoutController::class, '__invoke']);

    // Todos
    Route::get('/todos', [Api\TodoController::class, 'index']);
    Route::get('/todos/{todo}', [Api\TodoController::class, 'show']);
    Route::post('/todos/create', [Api\TodoController::class, 'store']);
    Route::put('/todos/update/{todo}', [Api\TodoController::class, 'update']);
    Route::delete('/todos/delete/{todo}', [Api\TodoController::class, 'destroy']);
});
