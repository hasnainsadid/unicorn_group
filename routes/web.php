<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OthersController;
// use App\Http\Controllers\Frontend\ContactController;

Route::get('/', function () {
    return view('frontend.pages.home.index');
})->name('home');
Route::get('/about', function () {
    return view('frontend.pages.about.index');
})->name('about');
// Route::post('/contact-us', ContactController::class)->name('contact.us');

require __DIR__ . '/admin.php';


Route::controller(OthersController::class)->group(function () {
   Route::get('/migrate', 'migrate')->name('migration');
   Route::get('/clear', 'clear')->name('clear');
   Route::get('/composer', 'composer')->name('composer');
   Route::get('/iseed', 'iseed')->name('iseed');
});