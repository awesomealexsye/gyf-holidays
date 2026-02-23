<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/destinations', [PageController::class, 'destinations'])->name('destinations');
Route::get('/coach-transportation', [PageController::class, 'coachTransportation'])->name('coach-transportation');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/packages/{categoryId}', [PageController::class, 'packageCategory'])->name('package-category');
Route::get('/package/{packageId}', [PageController::class, 'packageDetails'])->name('package-details');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');
