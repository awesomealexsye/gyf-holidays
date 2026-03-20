<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $totalEnquiries = Enquiry::count();
        $recentEnquiries = Enquiry::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalEnquiries', 'recentEnquiries'));
    }

    public function enquiries()
    {
        $enquiries = Enquiry::latest()->paginate(10);

        return view('admin.enquiries', compact('enquiries'));
    }

    public function enquiryDetails($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        return view('admin.enquiry-details', compact('enquiry'));
    }

    public function deleteEnquiry($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->route('admin.enquiries')->with('success', 'Enquiry deleted successfully.');
    }

    // SEO Pages Methods
    public function pages()
    {
        $pages = DynamicPage::latest()->paginate(10);

        return view('admin.pages.index', compact('pages'));
    }

    public function createPage()
    {
        $categories = Category::all();

        return view('admin.pages.create', compact('categories'));
    }

    public function storePage(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|unique:dynamic_pages,slug',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city_specific_content' => 'nullable|string',
            'seo_content' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string',
        ]);

        // Filter out empty FAQs
        if (isset($validated['faqs'])) {
            $validated['faqs'] = array_values(array_filter($validated['faqs'], function ($faq) {
                return ! empty($faq['question']) && ! empty($faq['answer']);
            }));
        }

        DynamicPage::create($validated);

        return redirect()->route('admin.pages')->with('success', 'SEO Page created successfully.');
    }

    public function editPage($id)
    {
        $page = DynamicPage::findOrFail($id);
        $categories = Category::all();

        return view('admin.pages.edit', compact('page', 'categories'));
    }

    public function updatePage(Request $request, $id)
    {
        $page = DynamicPage::findOrFail($id);
        $validated = $request->validate([
            'slug' => 'required|string|unique:dynamic_pages,slug,'.$id,
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city_specific_content' => 'nullable|string',
            'seo_content' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string',
        ]);

        // Filter out empty FAQs
        if (isset($validated['faqs'])) {
            $validated['faqs'] = array_values(array_filter($validated['faqs'], function ($faq) {
                return ! empty($faq['question']) && ! empty($faq['answer']);
            }));
        } else {
            $validated['faqs'] = [];
        }

        $page->update($validated);

        return redirect()->route('admin.pages')->with('success', 'SEO Page updated successfully.');
    }

    public function deletePage($id)
    {
        $page = DynamicPage::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages')->with('success', 'SEO Page deleted successfully.');
    }

    // Blog Posts Methods
    public function blogs()
    {
        $blogs = Blog::with('category')->latest('published_at')->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function createBlog()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();

        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    public function storeBlog(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|file|max:10240',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'author_name' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        // Filter empty FAQs
        if (isset($validated['faqs'])) {
            $validated['faqs'] = array_values(array_filter($validated['faqs'], function ($faq) {
                return ! empty($faq['question']) && ! empty($faq['answer']);
            }));
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs/featured', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');

        // Auto-set published_at to now if publishing without a date
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blog = Blog::create($validated);
        $blog->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.blogs')->with('success', 'Blog post created successfully.');
    }

    public function editBlog($id)
    {
        $blog = Blog::with('tags')->findOrFail($id);
        $categories = BlogCategory::all();
        $tags = BlogTag::all();

        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function updateBlog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug,'.$id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|file|max:10240',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'author_name' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        // Filter empty FAQs
        if (isset($validated['faqs'])) {
            $validated['faqs'] = array_values(array_filter($validated['faqs'], function ($faq) {
                return ! empty($faq['question']) && ! empty($faq['answer']);
            }));
        } else {
            $validated['faqs'] = [];
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blogs/featured', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');

        // Auto-set published_at to now if publishing without a date
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = $blog->published_at ?? now();
        }

        $blog->update($validated);
        $blog->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.blogs')->with('success', 'Blog post updated successfully.');
    }

    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        $blog->tags()->detach();
        $blog->delete();

        return redirect()->route('admin.blogs')->with('success', 'Blog post deleted successfully.');
    }

    public function uploadBlogImage(Request $request)
    {
        $request->validate(['file' => 'required|image|max:10240']);
        $path = $request->file('file')->store('blogs/content', 'public');

        return response()->json(['location' => '/storage/'.$path]);
    }

    // Blog Categories Methods
    public function blogCategories()
    {
        $categories = BlogCategory::withCount('blogs')->paginate(10);

        return view('admin.blog-categories.index', compact('categories'));
    }

    public function createBlogCategory()
    {
        return view('admin.blog-categories.create');
    }

    public function storeBlogCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_categories,slug',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        BlogCategory::create($validated);

        return redirect()->route('admin.blog-categories')->with('success', 'Blog category created successfully.');
    }

    public function editBlogCategory($id)
    {
        $category = BlogCategory::findOrFail($id);

        return view('admin.blog-categories.edit', compact('category'));
    }

    public function updateBlogCategory(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_categories,slug,'.$id,
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.blog-categories')->with('success', 'Blog category updated successfully.');
    }

    public function deleteBlogCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        if ($category->blogs()->count() > 0) {
            return redirect()->route('admin.blog-categories')->with('error', 'Cannot delete category with existing posts.');
        }
        $category->delete();

        return redirect()->route('admin.blog-categories')->with('success', 'Blog category deleted successfully.');
    }

    // Blog Tags Methods
    public function blogTags()
    {
        $tags = BlogTag::withCount('blogs')->paginate(10);

        return view('admin.blog-tags.index', compact('tags'));
    }

    public function createBlogTag()
    {
        return view('admin.blog-tags.create');
    }

    public function storeBlogTag(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_tags,slug',
        ]);

        BlogTag::create($validated);

        return redirect()->route('admin.blog-tags')->with('success', 'Blog tag created successfully.');
    }

    public function editBlogTag($id)
    {
        $tag = BlogTag::findOrFail($id);

        return view('admin.blog-tags.edit', compact('tag'));
    }

    public function updateBlogTag(Request $request, $id)
    {
        $tag = BlogTag::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_tags,slug,'.$id,
        ]);

        $tag->update($validated);

        return redirect()->route('admin.blog-tags')->with('success', 'Blog tag updated successfully.');
    }

    public function deleteBlogTag($id)
    {
        $tag = BlogTag::findOrFail($id);
        $tag->blogs()->detach();
        $tag->delete();

        return redirect()->route('admin.blog-tags')->with('success', 'Blog tag deleted successfully.');
    }
}
