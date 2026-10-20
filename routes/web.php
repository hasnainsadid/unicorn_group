<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\OthersController;
use App\Models\Client;
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
    return view('frontend.pages.management.index');
})->name('management');
Route::get('/product', function () {
    return view('frontend.pages.product.index');
})->name('product');
Route::get('/gallery', function () {
    return view('frontend.pages.gallery.index');
})->name('gallery');
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
    ->middleware('throttle:5,10')   // ek IP theke 10 minute e max 5 ta
    ->name('contact.store');

require __DIR__ . '/admin.php';


Route::controller(OthersController::class)->group(function () {
   Route::get('/migrate', 'migrate')->name('migration');
   Route::get('/clear', 'clear')->name('clear');
   Route::get('/composer', 'composer')->name('composer');
   Route::get('/iseed', 'iseed')->name('iseed');
});