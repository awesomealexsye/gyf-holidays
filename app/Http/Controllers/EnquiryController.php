<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Services\MailService;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'businessName' => 'required|string|max:255',
            'companyType' => 'required|string|max:255',
            'numberOfTravelers' => 'nullable|integer',
            'travelDate' => 'nullable|date',
            'destination' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Map request names to database columns
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'business_name' => $validated['businessName'],
            'company_type' => $validated['companyType'],
            'number_of_travelers' => $validated['numberOfTravelers'],
            'travel_date' => $validated['travelDate'],
            'destination' => $validated['destination'],
            'message' => $validated['message'],
        ];

        $enquiry = Enquiry::create($data);

        // Send Email
        MailService::sendEnquiryMail($data);

        return back()->with('success', 'Thank you for your enquiry. We will get back to you soon.');
    }
}
