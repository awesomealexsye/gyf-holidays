<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DynamicPage;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return !empty($faq['question']) && !empty($faq['answer']);
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
            'slug' => 'required|string|unique:dynamic_pages,slug,' . $id,
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
                return !empty($faq['question']) && !empty($faq['answer']);
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
}
