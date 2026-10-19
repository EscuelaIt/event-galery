<?php

use App\Http\Controllers\Galleries\GalleryController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');
});

require __DIR__.'/settings.php';
