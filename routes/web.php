<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/createMMMMMMM', [PostController::class, 'createMMMMMMM']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('create-post', [PostController::class, 'store'])->name('create-post');
    Route::get('/personal-blog', [PostController::class, 'personal_blog'])->name('personal-blog');
    Route::patch('/personal-blog', [PostController::class, 'update'])->name('personal-blog.update');
    Route::delete('/personal-blog', [PostController::class, 'destroy'])->name('personal-blog.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
