@extends('layouts.admin')

@section('page_title', 'Enquiry Details')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.enquiries') }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Enquiries
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Enquiry Message</h3>
                    <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-xs font-bold">{{ $enquiry->created_at->format('d M, Y h:i A') }}</span>
                </div>
                <div class="p-8">
                    <div class="prose max-w-none text-gray-700 leading-relaxed italic">
                        "{{ $enquiry->message ?? 'No message provided.' }}"
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 bg-gray-50 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Customer Info</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Full Name</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $enquiry->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email Address</p>
                        <a href="mailto:{{ $enquiry->email }}" class="text-primary-600 hover:underline font-medium">{{ $enquiry->email }}</a>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Phone Number</p>
                        <a href="tel:{{ $enquiry->phone }}" class="text-gray-800 font-medium">{{ $enquiry->phone }}</a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 bg-gray-50 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Business & Trip</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Business</p>
                            <p class="font-semibold text-gray-800">{{ $enquiry->business_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Type</p>
                            <p class="font-semibold text-gray-800">{{ $enquiry->company_type }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Destination</p>
                        <p class="font-semibold text-gray-800 text-lg">{{ $enquiry->destination ?? 'N/A' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Travelers</p>
                            <p class="font-semibold text-gray-800">{{ $enquiry->number_of_travelers ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Date</p>
                            <p class="font-semibold text-gray-800">{{ $enquiry->travel_date ? \Carbon\Carbon::parse($enquiry->travel_date)->format('d M, Y') : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
