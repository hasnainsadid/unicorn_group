<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OthersController;
use App\Http\Controllers\Frontend\ContactController;

Route::get('/', function () {
    return view('welcome');
});
// Route::post('/contact-us', ContactController::class)->name('contact.us');

require __DIR__ . '/admin.php';


Route::controller(OthersController::class)->group(function () {
   Route::get('/migrate', 'migrate')->name('migration');
   Route::get('/clear', 'clear')->name('clear');
   Route::get('/composer', 'composer')->name('composer');
   Route::get('/iseed', 'iseed')->name('iseed');
});