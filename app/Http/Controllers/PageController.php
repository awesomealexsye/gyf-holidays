<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\Package;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $packages = Package::latest()->take(6)->get();
        $dynamicPages = DynamicPage::where('is_active', true)->get();
        return view('pages.home', compact('categories', 'packages', 'dynamicPages'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function destinations()
    {
        $categories = Category::all();
        return view('pages.destinations', compact('categories'));
    }

    public function coachTransportation()
    {
        return view('pages.coach-transportation');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function packageCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $packages = $category->packages;
        
        return view('pages.package-category', compact('category', 'packages'));
    }

    public function packageDetails($packageId)
    {
        $package = Package::with('category')->findOrFail($packageId);
        $relatedPackages = Package::where('category_id', $package->category_id)
            ->where('id', '!=', $packageId)
            ->take(3)
            ->get();
            
        return view('pages.package-details', compact('package', 'relatedPackages'));
    }

    public function dynamicPage($slug)
    {
        $page = DynamicPage::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Fetch packages related to the category linked to this dynamic page
        $packages = collect();
        if ($page->category_id) {
            $packages = Package::where('category_id', $page->category_id)->get();
        }

        return view('pages.dynamic', compact('page', 'packages'));
    }
}
