<?php

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
// Concerns (menu: Concerns)
Route::prefix('concerns')->name('concern.')->group(function () {
    Route::view('/venture', 'frontend.pages.concerns.venture')->name('venture');
    Route::view('/elevator', 'frontend.pages.concerns.elevator.index')->name('elevator');
    Route::view('/elevator/blt', 'frontend.pages.concerns.elevator.blt')->name('elevator.blt');
    Route::view('/elevator/hidoks', 'frontend.pages.concerns.elevator.hidoks')->name('elevator.hidoks');
    Route::view('/elevator/sigma', 'frontend.pages.concerns.elevator.sigma')->name('elevator.sigma');
    // Elevator brands (add inside the concern. group, next to hidoks/blt/sigma)
    Route::view('/elevator/marsha', 'frontend.pages.concerns.elevator.marsha')->name('elevator.marsha');
    Route::view('/elevator/ife', 'frontend.pages.concerns.elevator.ife')->name('elevator.ife');
    Route::view('/elevator/xizi', 'frontend.pages.concerns.elevator.xizi')->name('elevator.xizi');
    Route::view('/elevator/fuji-sj', 'frontend.pages.concerns.elevator.fuji-sj')->name('elevator.fuji-sj');
    Route::view('/elevator/ningbo', 'frontend.pages.concerns.elevator.ningbo')->name('elevator.ningbo');
    Route::view('/elevator/mrf', 'frontend.pages.concerns.elevator.mrf')->name('elevator.mrf');

    Route::view('/energy', 'frontend.pages.concerns.energy')->name('energy');
    Route::view('/care', 'frontend.pages.concerns.care')->name('care');
    Route::view('/engineering', 'frontend.pages.concerns.engineering.index')->name('engineering');
    Route::view('/engineering/generator', 'frontend.pages.concerns.engineering.generator')->name('engineering.generator');
    Route::view('/engineering/substation', 'frontend.pages.concerns.engineering.substation')->name('engineering.substation');
    Route::view('/engineering/design', 'frontend.pages.concerns.engineering.design')->name('engineering.design');
    Route::view('/landmark', 'frontend.pages.concerns.landmark')->name('landmark');
});
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
