<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/sitemap', [SitemapController::class, 'index']);

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

// Blog
Route::get('/blog', [PageController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/category/{slug}', [PageController::class, 'blogCategory'])->name('blog.category');
Route::get('/blog/tag/{slug}', [PageController::class, 'blogTag'])->name('blog.tag');
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');

// Admin Auth Routes
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Panel Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Enquiries
    Route::get('/enquiries', [AdminController::class, 'enquiries'])->name('admin.enquiries');
    Route::get('/enquiry/{id}', [AdminController::class, 'enquiryDetails'])->name('admin.enquiry.details');
    Route::delete('/enquiry/{id}', [AdminController::class, 'deleteEnquiry'])->name('admin.enquiry.delete');

    // SEO Pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('admin.pages');
    Route::get('/page/create', [AdminController::class, 'createPage'])->name('admin.page.create');
    Route::post('/page/store', [AdminController::class, 'storePage'])->name('admin.page.store');
    Route::get('/page/{id}/edit', [AdminController::class, 'editPage'])->name('admin.page.edit');
    Route::put('/page/{id}', [AdminController::class, 'updatePage'])->name('admin.page.update');
    Route::delete('/page/{id}', [AdminController::class, 'deletePage'])->name('admin.page.delete');

    // Blog Posts
    Route::get('/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');
    Route::get('/blog/create', [AdminController::class, 'createBlog'])->name('admin.blog.create');
    Route::post('/blog/store', [AdminController::class, 'storeBlog'])->name('admin.blog.store');
    Route::get('/blog/{id}/edit', [AdminController::class, 'editBlog'])->name('admin.blog.edit');
    Route::put('/blog/{id}', [AdminController::class, 'updateBlog'])->name('admin.blog.update');
    Route::delete('/blog/{id}', [AdminController::class, 'deleteBlog'])->name('admin.blog.delete');
    Route::post('/blog/upload-image', [AdminController::class, 'uploadBlogImage'])->name('admin.blog.upload-image');

    // Blog Categories
    Route::get('/blog-categories', [AdminController::class, 'blogCategories'])->name('admin.blog-categories');
    Route::get('/blog-category/create', [AdminController::class, 'createBlogCategory'])->name('admin.blog-category.create');
    Route::post('/blog-category/store', [AdminController::class, 'storeBlogCategory'])->name('admin.blog-category.store');
    Route::get('/blog-category/{id}/edit', [AdminController::class, 'editBlogCategory'])->name('admin.blog-category.edit');
    Route::put('/blog-category/{id}', [AdminController::class, 'updateBlogCategory'])->name('admin.blog-category.update');
    Route::delete('/blog-category/{id}', [AdminController::class, 'deleteBlogCategory'])->name('admin.blog-category.delete');

    // Blog Tags
    Route::get('/blog-tags', [AdminController::class, 'blogTags'])->name('admin.blog-tags');
    Route::get('/blog-tag/create', [AdminController::class, 'createBlogTag'])->name('admin.blog-tag.create');
    Route::post('/blog-tag/store', [AdminController::class, 'storeBlogTag'])->name('admin.blog-tag.store');
    Route::get('/blog-tag/{id}/edit', [AdminController::class, 'editBlogTag'])->name('admin.blog-tag.edit');
    Route::put('/blog-tag/{id}', [AdminController::class, 'updateBlogTag'])->name('admin.blog-tag.update');
    Route::delete('/blog-tag/{id}', [AdminController::class, 'deleteBlogTag'])->name('admin.blog-tag.delete');
});

// Dynamic SEO Pages (MUST BE AT THE VERY END)
Route::get('/{slug}', [PageController::class, 'dynamicPage'])->name('dynamic.page');
