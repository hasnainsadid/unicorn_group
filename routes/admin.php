<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ContactController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.pages.dashboard.index');
        // return view('dashboard');
    })->name('dashboard');

    Route::resource('contacts', ContactController::class)->only(['index', 'destroy']);
    Route::get('contacts/recycle-bin', [ContactController::class, 'recycleBin'])->name('contacts.recycleBin');
    Route::post('contacts/restore/{id}', [ContactController::class, 'restore'])->name('contacts.restore');
    Route::delete('contacts/force-delete/{id}', [ContactController::class, 'forceDelete'])->name('contacts.forceDelete');
});