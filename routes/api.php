<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SecurityController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\SectorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Security routes
Route::post('/register', [SecurityController::class, 'register']);
Route::post('/login', [SecurityController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [SecurityController::class, 'logout']);
    Route::get('/users/me', [SecurityController::class, 'profile']);
    Route::put('/users/me', [SecurityController::class, 'update']);
    Route::put('/users/me/password', [SecurityController::class, 'updatePassword']);
});


//Resetting password
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/reset-password',[ForgotPasswordController::class, 'resetPassword']);


//Sector routes
Route::get('/sectors', [SectorController::class, 'allSectors']);

//Meal routes

Route::get('/meals', [MealController::class, 'index']);
Route::get('/meals/{meal}', [MealController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/meals', [MealController::class, 'store']);
    Route::get('/my-meals', [MealController::class, 'myMeals']);
    Route::put('/meals/{meal}', [MealController::class, 'update']);
    Route::delete('/meals/{meal}', [MealController::class, 'destroy']);

});


