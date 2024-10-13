<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);
Route::apiResource('posts.comments', CommentController::class);

Route::post('/login', AuthController::class . '@login');
Route::post('/register', AuthController::class . '@register');
Route::post('/logout', AuthController::class . '@logout');