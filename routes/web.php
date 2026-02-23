<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Public Pages
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

// Enquiry Submission
Route::post('/enquiry/submit', [EnquiryController::class, 'store'])->name('enquiry.submit');

// Admin Auth Routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Panel Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/enquiries', [AdminController::class, 'enquiries'])->name('admin.enquiries');
    Route::get('/enquiry/{id}', [AdminController::class, 'enquiryDetails'])->name('admin.enquiry.details');
    Route::delete('/enquiry/{id}', [AdminController::class, 'deleteEnquiry'])->name('admin.enquiry.delete');
});
