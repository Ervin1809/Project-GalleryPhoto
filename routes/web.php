<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\AdminController;


// ROUTES GUEST
Route::get('/', [ImageController::class, 'index'])->name('home');
Route::get('/images/{image}', [ImageController::class, 'show'])->name('images.show');


// ROUTE USER
Route::middleware(['auth', 'role:user'])->group(function () {

    // Review / komentar
    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');

    // Download high resolution
    Route::get('/download/{image}', [DownloadController::class, 'download'])
        ->name('images.download');

    // Breeze profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ROUTE ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/images', [AdminController::class, 'index'])
            ->name('images.index');

        Route::get('/images/create', [AdminController::class, 'create'])
            ->name('images.create');

        Route::post('/images', [AdminController::class, 'store'])
            ->name('images.store');
    });


// ROUTE BREEZE
require __DIR__.'/auth.php';
