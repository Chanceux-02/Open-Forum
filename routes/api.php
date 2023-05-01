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
Route::group(['middleware' => ['api']], function () {
    Route::post('/logout', [ApiUserController::class, 'logout']);
    Route::post('/login', [ApiUserController::class, 'login']); // got a 419 status error
});
Route::namespace('Api')->group(function () {

    // Route::get('/test', [ApiGetUserController::class, 'test']);
    Route::get('/home', [ApiGetUserController::class, 'index']);
    Route::get('/get/user/profile/{id}', [ApiGetUserController::class, 'getProfile']);
    Route::get('/get/edit/profile/{id}', [ApiGetUserController::class, 'editProfile']);
    Route::get('/get/post/{id}', [ApiGetUserController::class, 'editPost']);
    Route::get('/get/comment/{id}', [ApiGetUserController::class, 'comment']);
    Route::get('/get/comment/{id}', [ApiGetUserController::class, 'editCom']);
    Route::get('/search/{id}', [ApiGetUserController::class, 'search']);

    Route::post('/update/{id}', [ApiUserController::class, 'update']);
    Route::post('/register', [ApiUserController::class, 'register']);
    
    Route::post('/update/post/{uid}/{pid}', [ApiPostController::class, 'updatePost']);
    Route::post('/store/post/{uid}', [ApiPostController::class, 'store']);
    Route::post('/like/post/{uid}/{pid}', [ApiPostController::class, 'like']);
    Route::post('/store/comment/{uid}/{pid}', [ApiPostController::class, 'storeComment']);
    Route::post('/like/comment/{uid}', [ApiPostController::class, 'likeComment']);
    Route::post('/edit/comment/{uid}', [ApiPostController::class, 'editCom']);
    
    Route::delete('/delete/post/{id}', [ApiPostController::class, 'destroy']);
    Route::delete('/delete/comment/{id}', [ApiPostController::class, 'destroyCom']);
    
});


