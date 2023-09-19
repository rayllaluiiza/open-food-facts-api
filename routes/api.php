<?php

use App\Http\Controllers\API\{APIStatusController, ProductController, UserController};
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
Route::post('/token', [UserController::class, 'authenticate']);
//Route::post('/user', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('status', [APIStatusController::class, 'index']);
    Route::apiResource('produtos', ProductController::class)->except('store');
});
