<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OthersController;
use App\Http\Controllers\Frontend\ContactController;

Route::get('/', function () {
    return view('frontend.pages.home.index');
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
Route::get('/spare-part', function () {
    return view('frontend.pages.spare_parts.index');
})->name('spare.part');
Route::get('/project', function () {
    return view('frontend.pages.project.index');
})->name('project');
Route::get('/gallery', function () {
    return view('frontend.pages.gallery.index');
})->name('gallery');
Route::get('/contact', function () {
    return view('frontend.pages.contact.index'); 
})->name('contact');

require __DIR__ . '/admin.php';


Route::controller(OthersController::class)->group(function () {
   Route::get('/migrate', 'migrate')->name('migration');
   Route::get('/clear', 'clear')->name('clear');
   Route::get('/composer', 'composer')->name('composer');
   Route::get('/iseed', 'iseed')->name('iseed');
});