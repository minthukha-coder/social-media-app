<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UiController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {

    Route::get('/', [UiController::class, 'index'])->name('home');

    Route::resource('posts', PostController::class);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/posts/comments/{postId}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/posts/comments/{commentId}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/posts/comments/{commentId}/update', [CommentController::class, 'update'])->name('comment.update');

    Route::delete('/posts/comment/{commentId}/delete', [CommentController::class, 'destroy'])->name('comment.destroy');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});
