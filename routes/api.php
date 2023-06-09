<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostCommentController;
use App\Http\Controllers\UserPostController;
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

Route::resource('users', UserController::class);
Route::resource('users.posts', UserPostController::class);
Route::resource('posts.comments', UserPostCommentController::class);

Route::get('/posts', [UserPostController::class, 'index']); 

Route::delete('/posts', [UserPostController::class, 'destroy']); 
