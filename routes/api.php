<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('galleries', [GalleryController::class, 'listGalleries'])->name('galleries.list');
});
