<?php

use App\Http\Controllers\Frontend\ConcernController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\SeoController;
use App\Http\Controllers\OthersController;
use App\Models\Client;
use App\Models\Management;
use App\Models\Slider;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $sliders = Slider::active()->get();
    $clients = Client::ordered()->get();
    return view('frontend.pages.home.index', compact('sliders', 'clients'));
})->name('home');
Route::get('/about', function () {
    return view('frontend.pages.about.index');
})->name('about');
Route::get('/management', function () {
    $managements = Management::ordered()->get();
    return view('frontend.pages.management.index', compact('managements'));
})->name('management');
Route::get('/product', function () {
    return view('frontend.pages.product.index');
})->name('product');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/{album}', [GalleryController::class, 'show'])->name('gallery.album');
Route::prefix('gallery')->name('gallery.')->group(function () {
    Route::view('/projects', 'frontend.pages.gallery.projects')->name('projects');
    Route::view('/doors', 'frontend.pages.gallery.doors')->name('doors');
    Route::view('/interiors', 'frontend.pages.gallery.interiors')->name('interiors');
});

// Concerns: every page (menu, series, brands) comes from the admin panel
Route::get('/concern/{path}', [ConcernController::class, 'show'])
    ->where('path', '[A-Za-z0-9\-/]+')
    ->name('concern.show');

Route::get('/contact', function () {
    return view('frontend.pages.contact.index');
})->name('contact');

Route::post('/contact', ContactController::class)
    ->middleware('throttle:5,10') // ek IP theke 10 minute e max 5 ta
    ->name('contact.store');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots']);

require __DIR__ . '/admin.php';

Route::controller(OthersController::class)->group(function () {
    Route::get('/migrate', 'migrate')->name('migration');
    Route::get('/clear', 'clear')->name('clear');
    Route::get('/composer', 'composer')->name('composer');
    Route::get('/iseed', 'iseed')->name('iseed');
});