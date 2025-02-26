<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users');

    Route::get('/view-posts', [PostController::class, 'view_posts'])->name('view-posts');

    Route::get('/personal-blog', [PostController::class, 'personal_blog'])->name('personal-blog');
    Route::post('/personal-blog', [PostController::class, 'store'])->name('personal-blog.create');
    Route::patch('/personal-blog', [PostController::class, 'update'])->name('personal-blog.update');
    Route::delete('/personal-blog', [PostController::class, 'destroy'])->name('personal-blog.destroy');

    Route::post('/post-tag-sub', [PostTagController::class, 'store'])->name('post-tag-sub.create');
    Route::delete('/post-tag-sub', [PostTagController::class, 'destroy'])->name('post-tag-sub.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
