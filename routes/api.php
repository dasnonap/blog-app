<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
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
    Route::controller(PostsController::class)->group(function () {
        Route::post('/posts/create', 'create')->name('posts.create');

        Route::get('/posts/{post}/edit', 'edit')->name('posts.edit');

        Route::post('/posts/{post}/edit', 'update')->name('posts.update');

        // User - Post Iteraction
        Route::patch('/posts/{post}/like', 'like')->name('posts.like');

        Route::patch('/posts/{post}/unlike', 'unlike')->name('posts.unlike');

        Route::patch('/posts/{post}/dislike', 'dislike')->name('posts.dislike');

        Route::patch('/posts/{post}/undislike', 'undislike')->name('posts.undislike');
    });

    Route::controller(TagsController::class)->group(function () {
        Route::post('/tags/create', 'create')->name('tags.create');

        Route::post('/tags/{tag}/update', 'update')->name('tags.update');
    });
});
