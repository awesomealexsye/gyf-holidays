@extends('layouts.app')

@section('title', 'GYF Holidays - Your Trusted B2B Travel Partner')
@section('meta_description', 'GYF Holidays offers premium B2B travel and tour packages for corporate clients, group bookings, and customized holiday trips worldwide.')
@section('meta_keywords', 'B2B Travel Partner, Corporate Travel Solutions, Group Bookings, Customized Tour Packages, International Travel Agency, GYF Holidays')

@section('content')
    @php
        $services = [
            [
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>',
                'title' => 'Corporate Travel',
                'description' => 'Comprehensive corporate travel solutions tailored to your business needs.',
                'color' => 'bg-blue-500',
            ],
            [
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
                'title' => 'Group Bookings',
                'description' => 'Specialized group travel packages with exclusive rates and benefits.',
                'color' => 'bg-purple-500',
            ],
            [
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                'title' => 'Customized Packages',
                'description' => 'Personalized travel experiences designed around your preferences.',
                'color' => 'bg-green-500',
            ],
            [
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
                'title' => 'B2B Solutions',
                'description' => 'Complete B2B travel services with dedicated account management.',
                'color' => 'bg-orange-500',
            ],
        ];

        $testimonials = [
            [
                'name' => 'Rajesh Kumar',
                'company' => 'Tech Solutions Pvt. Ltd.',
                'text' => 'GYF Holidays made our corporate retreat absolutely seamless. Their attention to detail and professionalism is unmatched.',
                'rating' => 5,
            ],
            [
                'name' => 'Priya Sharma',
                'company' => 'Global Travel Agency',
                'text' => 'As a B2B partner, GYF has consistently delivered exceptional service. Their packages are competitive and quality is outstanding.',
                'rating' => 5,
            ],
            [
                'name' => 'Amit Patel',
                'company' => 'Event Masters India',
                'text' => 'We have been working with GYF for 3 years. They understand our needs and always go the extra mile.',
                'rating' => 5,
            ],
        ];

        $whyChooseUs = [
            [
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
                'title' => 'Best Prices',
                'description' => 'Competitive B2B rates with maximum value',
            ],
            [
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                'title' => '24/7 Support',
                'description' => 'Round-the-clock assistance for all your needs',
            ],
            [
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
                'title' => 'Trusted Partner',
                'description' => '10+ years of excellence in travel industry',
            ],
            [
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976-2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>',
                'title' => 'Quality Service',
                'description' => 'Premium experiences with every booking',
            ],
        ];
    @endphp

    <x-hero
        title="Your Trusted B2B Travel Partner"
        subtitle="Discover exceptional corporate travel solutions, customized packages, and unforgettable experiences for your business clients."
    />

    <x-stats />

    <!-- Services Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Our Services
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Comprehensive B2B travel solutions designed to meet your business needs
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($services as $index => $service)
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-shadow group">
                        <div class="{{ $service['color'] }} w-16 h-16 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <div class="text-white">
                                {!! $service['icon'] !!}
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service['title'] }}</h3>
                        <p class="text-gray-600">{{ $service['description'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a
                    href="/services"
                    class="inline-block px-8 py-4 gradient-primary text-white rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-1 transition-all"
                >
                    View All Services
                </a>
            </div>
        </div>
    </section>

    <!-- Tour Packages -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Tour Packages
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Choose from our most popular tour categories and discover amazing travel experiences
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-500">
                        <a href="/packages/{{ $category['id'] }}" class="flex flex-col h-full">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <img
                                    src="{{ $category['image'] }}"
                                    alt="{{ $category['name'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                >
                                <div class="absolute inset-0 bg-black/5 group-hover:bg-black/0 transition-colors duration-500"></div>
                            </div>
                            <div class="p-8 flex-grow flex flex-col items-center text-center">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary-600 transition-colors">
                                    {{ $category['name'] }}
                                </h3>
                                <p class="text-gray-600 mb-6 line-clamp-2">
                                    {{ $category['description'] }}
                                </p>
                                <div class="mt-auto inline-flex items-center text-primary-600 font-bold group-hover:translate-x-2 transition-transform duration-300">
                                    View Packages 
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a
                    href="/destinations"
                    class="inline-block px-8 py-4 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transform hover:-translate-y-1 transition-all shadow-lg"
                >
                    Explore All Regions
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Why Choose GYF Holidays
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Your success is our priority. Here's why businesses trust us
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($whyChooseUs as $item)
                    <div class="text-center">
                        <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <div class="text-primary-600">
                                {!! $item['icon'] !!}
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-gray-600">{{ $item['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    What Our Clients Say
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Don't just take our word for it - hear from our satisfied B2B partners
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white rounded-xl p-8 shadow-lg">
                        <svg class="text-primary-200 w-10 h-10 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C15.4647 8 15.017 8.44772 15.017 9V12M14.017 21H11.017C10.4647 21 10.017 20.5523 10.017 20V12C10.017 11.4477 10.4647 11 11.017 11H13.017V9C13.017 6.23858 15.2556 4 18.017 4H19.017C19.5693 4 20.017 4.44772 20.017 5V7C20.017 7.55228 19.5693 8 19.017 8H18.017C17.4647 8 17.017 8.44772 17.017 9V11H19.017C20.1216 11 21.017 11.8954 21.017 13V15C21.017 18.3137 18.3307 21 15.017 21H14.017ZM5.017 21L5.017 18C5.017 16.8954 5.91243 16 7.017 16H10.017C10.5693 16 11.017 15.5523 11.017 15V9C11.017 8.44772 10.5693 8 10.017 8H7.017C6.46472 8 6.017 8.44772 6.017 9V12M5.017 21H2.017C1.46472 21 1.017 20.5523 1.017 20V12C1.017 11.4477 1.46472 11 2.017 11H4.017V9C4.017 6.23858 6.25558 4 9.017 4H10.017C10.5693 4 11.017 4.44772 11.017 5V7C11.017 7.55228 10.5693 8 10.017 8H9.017C8.46472 8 8.017 8.44772 8.017 9V11H10.017C11.1216 11 12.017 11.8954 12.017 13V15C12.017 18.3137 9.33071 21 6.017 21H5.017Z"/></svg>
                        <div class="flex mb-4">
                            @for($i = 0; $i < $testimonial['rating']; $i++)
                                <svg class="text-yellow-400 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            @endfor
                        </div>
                        <p class="text-gray-600 mb-6 italic">{{ $testimonial['text'] }}</p>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $testimonial['name'] }}</h4>
                            <p class="text-sm text-gray-500">{{ $testimonial['company'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-process />

    <x-journey-stepper />

    <!-- Ready to Start -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        Ready to Start Your Journey?
                    </h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Get in touch with us today and let's create unforgettable travel experiences for your business clients.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="text-primary-600 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Customized Solutions</h4>
                                <p class="text-gray-600">Tailored to your business needs</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="text-primary-600 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Best Rates</h4>
                                <p class="text-gray-600">Competitive B2B pricing</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="text-primary-600 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">24/7 Support</h4>
                                <p class="text-gray-600">Always here when you need us</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <x-contact-form title="Get a Quick Quote" :compact="true" />
                </div>
            </div>
        </div>
    </section>
@endsection
