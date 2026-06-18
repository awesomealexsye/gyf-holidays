@extends('layouts.app')

@section('title', 'Contact Us - GYF Holidays | B2B Travel Inquiry & Support')
@section('meta_description', 'Contact GYF Holidays for B2B travel inquiries, Europe tour packages, corporate bookings, and customized holiday solutions. Visit our Delhi office or reach us 24/7.')
@section('meta_keywords', 'Contact GYF Holidays, B2B Travel Inquiry, Corporate Booking Support, Travel Agency Help, Delhi Travel Office')

@push('schema')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "{{ config('gyf.company.name') }}",
        "image": "{{ asset('logo.png') }}",
        "telephone": "{{ config('gyf.contact.phone') }}",
        "email": "{{ config('gyf.contact.email') }}",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ config('gyf.contact.address.street') }}",
            "addressLocality": "{{ config('gyf.contact.address.city') }}",
            "addressRegion": "{{ config('gyf.contact.address.state') }}",
            "postalCode": "{{ config('gyf.contact.address.zip') }}",
            "addressCountry": "IN"
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "opens": "10:00",
            "closes": "19:00"
        },
        "url": "{{ config('app.url') }}"
    }
    </script>
@endpush

@section('content')
    <x-hero
        title="Get In Touch"
        subtitle="GYF Holidays - We're here to help you create unforgettable travel experiences"
        backgroundImage="https://images.unsplash.com/photo-1423666639041-f56000c27a9a"
        :showCTA="false"
        height="h-[400px]"
    />

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Send Us an Inquiry</h2>
                    <x-contact-form />
                </div>

                <!-- Contact Details -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Offices</h2>
                    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">India Office</h3>
                                    <p class="text-gray-600">{{ config('gyf.contact.address.street') }}, {{ config('gyf.contact.address.city') }}, {{ config('gyf.contact.address.state') }} {{ config('gyf.contact.address.zip') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">International Office (Belgium)</h3>
                                    <p class="text-gray-600">{{ config('gyf.contact.internationalAddress.name') }}, {{ config('gyf.contact.internationalAddress.street') }}, {{ config('gyf.contact.internationalAddress.zip') }} {{ config('gyf.contact.internationalAddress.city') }}, {{ config('gyf.contact.internationalAddress.country') }}</p>
                                    <a href="tel:{{ config('gyf.contact.internationalPhone') }}" class="text-primary-600 hover:underline">{{ config('gyf.contact.internationalPhone') }}</a><br>
                                    <a href="mailto:{{ config('gyf.contact.internationalEmail') }}" class="text-primary-600 hover:underline">{{ config('gyf.contact.internationalEmail') }}</a>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">Phone</h3>
                                    <a href="tel:{{ config('gyf.contact.phone') }}" class="text-primary-600 hover:underline">{{ config('gyf.contact.phone') }}</a>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">Email</h3>
                                    <a href="mailto:{{ config('gyf.contact.email') }}" class="text-primary-600 hover:underline">{{ config('gyf.contact.email') }}</a><br>
                                    <a href="mailto:{{ config('gyf.contact.salesEmail') }}" class="text-primary-600 hover:underline">{{ config('gyf.contact.salesEmail') }}</a>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-1">Business Hours</h3>
                                    <p class="text-gray-600">{{ config('gyf.businessHours.weekdays') }}</p>
                                    <p class="text-gray-600">{{ config('gyf.businessHours.sunday') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Google Map -->
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Find Us on Map</h2>
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <iframe
                            src="{{ config('gyf.mapEmbedUrl') }}"
                            width="100%"
                            height="300"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="GYF Holidays Office Location"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
