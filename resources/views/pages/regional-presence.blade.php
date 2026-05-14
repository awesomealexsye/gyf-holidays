@extends('layouts.app')

@section('title', 'Our Regional Presence - GYF Holidays')
@section('meta_description', 'Explore GYF Holidays\' regional presence across major Indian cities. Premium European, Scandinavian, and UK B2B travel solutions for travel agents nationwide.')
@section('meta_keywords', 'B2B DMC India, Europe DMC, Scandinavia DMC, UK DMC, Regional Presence, GYF Holidays Locations')

@section('content')
    <x-hero
        title="Our Regional Presence"
        subtitle="Connecting businesses with premium European travel solutions across major Indian cities"
        backgroundImage="/pictures/swiss-package/swiss-package-1.jpeg"
        :showCTA="false"
        height="h-[400px]"
    />

    <section class="py-24 bg-gray-50/50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="inline-flex items-center space-x-2 bg-primary-100 text-primary-800 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider mb-6">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    <span>Our Global Network</span>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">
                    All <span class="text-primary-600">Locations</span>
                </h1>
                <p class="text-gray-500 max-w-2xl mx-auto font-medium">
                    Browse our complete list of B2B destination management services across Indian cities.
                </p>
            </div>

            @if($dynamicPages->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($dynamicPages as $page)
                        <a href="/{{ $page->slug }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-primary-900/5 hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-primary-50 text-primary-600 rounded-xl flex items-center justify-center group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <span class="text-gray-700 group-hover:text-primary-600 font-bold transition-colors duration-300">{{ $page->title }}</span>
                                </div>
                                <svg class="w-4 h-4 text-gray-300 group-hover:text-primary-600 transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500 py-12">
                    <p>No locations available at the moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
