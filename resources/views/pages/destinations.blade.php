@extends('layouts.app')

@section('title', 'Explore Destinations - GYF Holidays')
@section('meta_description', 'Discover premium B2B tour packages for Europe, UK, Ireland, Scotland, and Scandinavia. Tailor-made itineraries for corporate and group travel.')
@section('meta_keywords', 'Europe Destinations, UK Tour Packages, Scandinavia Travel, B2B Travel Destinations, Global Tour Planning')

@section('content')
    <x-hero
        title="Explore Destinations"
        subtitle="Discover amazing places around the world for your next corporate trip or group booking"
        backgroundImage="/pictures/swiss-package/swiss-package-1.jpeg"
        :showCTA="false"
        height="h-[400px]"
    />

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
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
                            </div>
                            <div class="p-8 flex-grow flex flex-col items-center text-center">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary-600 transition-colors">
                                    {{ $category['name'] }}
                                </h3>
                                <p class="text-gray-600 mb-6 line-clamp-2">
                                    {{ $category['description'] }}
                                </p>
                                <div class="mt-auto inline-flex items-center text-primary-600 font-bold">
                                    View Packages 
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
