<?php

namespace App\Http\Controllers;

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
}
