<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('posts', PostController::class)->only(['index', 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class)->except(['index', 'show']);
});

Route::apiResource('posts.comments', CommentController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts.comments', CommentController::class)->except(['index', 'show']);
});

Route::post('/login', AuthController::class . '@login');
Route::post('/register', AuthController::class . '@register');
Route::post('/logout', AuthController::class . '@logout');