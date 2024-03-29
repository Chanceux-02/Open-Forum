<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//default names for routing

// home - URL: /, function: HomeController@index
// login - URL: /login, function: Auth\LoginController@showLoginForm
// login.post - URL: /login, function: Auth\LoginController@login
// logout - URL: /logout, function: Auth\LoginController@logout
// register - URL: /register, function: Auth\RegisterController@showRegistrationForm
// register.post - URL: /register, function: Auth\RegisterController@register
// password.request - URL: /password/reset, function: Auth\ForgotPasswordController@showLinkRequestForm
// password.email - URL: /password/email, function: Auth\ForgotPasswordController@sendResetLinkEmail
// password.reset - URL: /password/reset/{token}, function: Auth\ResetPasswordController@showResetForm
// password.update - URL: /password/reset, function: Auth\ResetPasswordController@reset
// users.index - URL: /users, function: UserController@index
// users.create - URL: /users/create, function: UserController@create
// users.store - URL: /users, function: UserController@store
// users.show - URL: /users/{user}, function: UserController@show
// users.edit - URL: /users/{user}/edit, function: UserController@edit
// users.update - URL: /users/{user}, function: UserController@update
// users.destroy - URL: /users/{user}, function: UserController@destroy
// posts.index - URL: /posts, function: PostController@index
// posts.create - URL: /posts/create, function: PostController@create
// posts.store - URL: /posts, function: PostController@store
// posts.show - URL: /posts/{post}, function: PostController@show
// posts.edit - URL: /posts/{post}/edit, function: PostController@edit
// posts.update - URL: /posts/{post}, function: PostController@update
// posts.destroy - URL: /posts/{post}, function: PostController@destroy

//for showing the page
Route::get('/home', [GetUserController::class, 'index'])->name('Home-page')->middleware(['auth', 'preventBackHistory']);
Route::get('/', [GetUserController::class, 'login'])->name('login-page')->middleware(['guest', 'preventBackHistory']);
Route::get('/register', [GetUserController::class, 'register'])->name('register-page');
Route::get('/add/post', [GetUserController::class, 'createPost'])->name('create-post');
Route::get('/user/profile', [GetUserController::class, 'profile'])->name('user-profile');
Route::get('/edit/profile', [GetUserController::class, 'edit'])->name('edit-profile');
Route::get('/edit/post/{id}', [GetUserController::class, 'editPost'])->name('edit-post');
Route::get('/delete/post/{id}', [GetUserController::class, 'destroy'])->name('delete-post');
Route::get('/show/comment/{id}', [GetUserController::class, 'comment'])->name('comment-post');
Route::get('/edit/comment/{id}/{postId}', [GetUserController::class, 'editCom'])->name('get-edit-com');
Route::get('/search', [GetUserController::class, 'search'])->name('search');

Route::post('/register', [UserController::class, 'create']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/upload/post', [PostController::class, 'store']);
Route::post('/upload/comment/{id}', [PostController::class, 'storeComment'])->name('answer-post');
Route::post('/like/post', [PostController::class, 'like']);
Route::post('/like/comment', [PostController::class, 'likeComment'])->name('like-comment');
Route::post('/delete/comment/{id}', [PostController::class, 'destroyCom'])->name('delete-com');

Route::put('/update/profile', [UserController::class, 'update']);
Route::put('/update/post/{id}', [PostController::class, 'updatePost'])->name('update-post');
Route::put('/update/comment', [PostController::class, 'editCom'])->name('update-com');

