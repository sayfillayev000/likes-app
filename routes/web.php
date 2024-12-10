<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Comment;

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('product.index');
    });

    Route::get('/dashboard', function () {
        return redirect()->route('product.index');
    })->name('dashboard');

    Route::resources([
        'product' => ProductController::class,
        'like' => LikeController::class,
        'comment' => CommentController::class,
    ]);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
