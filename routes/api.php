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
Route::namespace('Api')->group(function () {

    // Route::get('/test', [ApiGetUserController::class, 'test']);
    Route::get('/home', [ApiGetUserController::class, 'index']);
    Route::get('/get/user/profile/{id}', [ApiGetUserController::class, 'profile']);
    Route::get('/get/profile/{id}', [ApiGetUserController::class, 'edit']);
    Route::get('/get/post/{id}', [ApiGetUserController::class, 'editPost']);
    Route::get('/show/comment/{id}', [ApiGetUserController::class, 'comment']);
    Route::get('/get/comment/{id}', [ApiGetUserController::class, 'editCom']);
    
    Route::get('/search/{id}', [ApiGetUserController::class, 'search']);
    
    Route::post('/register', [ApiUserController::class, 'register']);
    Route::post('/update/{id}', [ApiUserController::class, 'update']);
    
    Route::delete('/delete/post/{id}', [ApiGetUserController::class, 'destroy']);
    Route::delete('/delete/{id}', [ApiPostController::class, 'destroyCom']);
    
});




