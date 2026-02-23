<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    private function getData($file)
    {
        $path = resource_path("data/{$file}.json");
        return collect(json_decode(File::get($path), true));
    }

    public function home()
    {
        $categories = $this->getData('categories');
        $packages = $this->getData('packages')->take(6);
        return view('pages.home', compact('categories', 'packages'));
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
        $categories = $this->getData('categories');
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
        $categories = $this->getData('categories');
        $category = $categories->firstWhere('id', $categoryId);
        
        if (!$category) {
            abort(404);
        }

        $packages = $this->getData('packages')->where('categoryId', $categoryId);
        
        return view('pages.package-category', compact('category', 'packages'));
    }

    public function packageDetails($packageId)
    {
        $packages = $this->getData('packages');
        $package = $packages->firstWhere('id', $packageId);
        
        if (!$package) {
            abort(404);
        }

        $relatedPackages = $packages->where('categoryId', $package['categoryId'])
            ->where('id', '!=', $packageId)
            ->take(3);
            
        return view('pages.package-details', compact('package', 'relatedPackages'));
    }
}
