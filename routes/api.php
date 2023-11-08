<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/recipe', \App\Http\Controllers\RecipeController::class);
Route::resource('/ingredients', \App\Http\Controllers\IngredientsController::class);
Route::resource('/step-to-cook', \App\Http\Controllers\StepToCookController::class);
