<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\Package;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $staticPages = [
            route('home'),
            route('about'),
            route('services'),
            route('destinations'),
            route('coach-transportation'),
            route('contact'),
            route('privacy'),
            route('terms'),
        ];

        $categories = Category::all();
        $packages = Package::all();
        $dynamicPages = DynamicPage::where('is_active', true)->get();

        return response()->view('sitemap', [
            'staticPages' => $staticPages,
            'categories' => $categories,
            'packages' => $packages,
            'dynamicPages' => $dynamicPages,
        ])->header('Content-Type', 'text/xml');
    }
}
