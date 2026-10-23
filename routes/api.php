<?php

use App\Http\Controllers\Galleries\ListGalleriesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('galleries', ListGalleriesController::class)->name('galleries.list');
});
