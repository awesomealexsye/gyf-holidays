<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\Package;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $packages = Package::latest()->take(6)->get();
        $dynamicPages = DynamicPage::where('is_active', true)->latest()->take(8)->get();

        return view('pages.home', compact('categories', 'packages', 'dynamicPages'));
    }

    public function regionalPresence()
    {
        $dynamicPages = DynamicPage::where('is_active', true)->latest()->get();

        return view('pages.regional-presence', compact('dynamicPages'));
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

    public function blogIndex()
    {
        $blogs = Blog::published()
            ->with('category')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.blog-index', [
            'blogs' => $blogs,
            'title' => 'Travel Blog',
            'description' => 'Travel tips, destination guides, and industry insights from GYF Holidays.',
        ]);
    }

    public function blogShow($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->published()
            ->with(['category', 'tags'])
            ->firstOrFail();

        $relatedPosts = Blog::published()
            ->where('id', '!=', $blog->id)
            ->when($blog->blog_category_id, function ($q) use ($blog) {
                $q->where('blog_category_id', $blog->blog_category_id);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.blog-details', compact('blog', 'relatedPosts'));
    }

    public function blogCategory($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        $blogs = Blog::published()
            ->where('blog_category_id', $category->id)
            ->with('category')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.blog-index', [
            'blogs' => $blogs,
            'category' => $category,
            'title' => $category->name,
            'description' => $category->meta_description ?? $category->description ?? 'Blog posts in '.$category->name,
        ]);
    }

    public function blogTag($slug)
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();

        $blogs = Blog::published()
            ->whereHas('tags', fn ($q) => $q->where('blog_tags.id', $tag->id))
            ->with('category')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.blog-index', [
            'blogs' => $blogs,
            'tag' => $tag,
            'title' => 'Tagged: '.$tag->name,
            'description' => 'Blog posts tagged with '.$tag->name,
        ]);
    }

    public function dynamicPage($slug)
    {
        // Fallback for sitemap.xml if the main route is missed in production
        if ($slug === 'sitemap.xml') {
            return app(SitemapController::class)->index();
        }

        // 301 Redirect old slugs to new SEO-optimized slugs
        if (array_key_exists($slug, DynamicPage::SLUG_REDIRECTS)) {
            return redirect('/'.DynamicPage::SLUG_REDIRECTS[$slug], 301);
        }

        $page = DynamicPage::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Fetch packages related to the category linked to this dynamic page
        $packages = collect();
        if ($page->category_id) {
            $packages = Package::where('category_id', $page->category_id)->get();
        }

        // Fetch related dynamic pages for internal linking (same region or same city)
        $relatedPages = DynamicPage::where('is_active', true)
            ->where('id', '!=', $page->id)
            ->get()
            ->filter(function ($p) use ($page) {
                return $p->city === $page->city || $p->region === $page->region;
            })
            ->take(6);

        return view('pages.dynamic', compact('page', 'packages', 'relatedPages'));
    }
}
