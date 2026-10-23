<?php

use App\Http\Controllers\Backend\AboutSectionController;
use App\Http\Controllers\Backend\AlbumController;
use App\Http\Controllers\Backend\AlbumImageController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ManagementController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Middleware\CheckUploads;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', CheckUploads::class,
])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.pages.dashboard.index');
        // return view('dashboard');
    })->name('dashboard');

    Route::resource('sliders', SliderController::class);
    Route::post('sliders/{slider}/toggle', [SliderController::class, 'toggle'])->name('sliders.toggle');

    Route::resource('about-sections', AboutSectionController::class)->only(['index', 'edit', 'update']);

    Route::resource('clients', ClientController::class)->except('show');

    Route::resource('managements', ManagementController::class)->only(['index', 'edit', 'update']);

    Route::post('albums/reorder', [AlbumController::class, 'reorder'])->name('albums.reorder');
    Route::resource('albums', AlbumController::class)->except('show');
    Route::post('albums/{album}/images', [AlbumImageController::class, 'store'])->name('albums.images.store');
    Route::post('albums/{album}/images/reorder', [AlbumImageController::class, 'reorder'])->name('albums.images.reorder');
    Route::put('album-images/{image}', [AlbumImageController::class, 'update'])->name('album-images.update');
    Route::delete('album-images/{image}', [AlbumImageController::class, 'destroy'])->name('album-images.destroy');

    Route::resource('contacts', ContactController::class)->only(['index', 'destroy']);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
