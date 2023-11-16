<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SecurityController;
use App\Http\Controllers\MealController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Security routes
Route::post('/register', [SecurityController::class, 'register']);
Route::post('/login', [SecurityController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [SecurityController::class, 'logout']);
});

//Meal routes

Route::get('/meals', [MealController::class, 'index']);
Route::get('/meals/{meal}', [MealController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/meals', [MealController::class, 'store']);
    Route::get('/my-meals', [MealController::class, 'myMeals']);
    Route::put('/meals/{meal}', [MealController::class, 'update']);
    Route::delete('/meals/{meal}', [MealController::class, 'destroy']);

});

