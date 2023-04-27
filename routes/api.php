<?php

use App\Http\Controllers\Api\ApiGetUserController;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiUserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::namespace('Api')->group(function () {
// });

Route::get('/test', [ApiGetUserController::class, 'test']);

Route::post('/delete/{id}', [ApiPostController::class, 'destroyCom']);

Route::post('/register', [ApiUserController::class, 'register']); //200 ok pero wala naga sulod ang inputs


