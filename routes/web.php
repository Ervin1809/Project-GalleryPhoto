<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\AdminController;

// ===== PUBLIC ROUTES =====
Route::get('/', [ImageController::class, 'index'])->name('home');
Route::get('/images/{image}', [ImageController:: class, 'show'])->name('images.show');

// ===== AUTH ROUTES (Breeze) =====
require __DIR__.'/auth.php';  // TETAP (untuk login/register/logout)

// ===== AUTHENTICATED USER ROUTES =====
Route::middleware('auth')->group(function () {
    // Review/Comment
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Download HD image
    Route::get('/download/{image}', [DownloadController::class, 'download'])->name('images.download');

    // HAPUS PROFILE ROUTES (tidak perlu lagi)
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/images', [AdminController::class, 'index'])->name('images.index');
        Route::get('/images/create', [AdminController::class, 'create'])->name('images.create');
        Route::post('/images', [AdminController::class, 'store'])->name('images.store');
        Route::delete('/images/{image}', [AdminController::class, 'destroy'])->name('images.destroy');
    });
