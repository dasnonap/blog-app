<?php

use App\Http\Controllers\PostsController;
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

// Fetch All posts (Paginated response)
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected routes
Route::middleware("auth:sanctum")->group(function () {
    Route::post('/posts/create', [PostsController::class, 'create'])->name('posts.edit');

    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
});
