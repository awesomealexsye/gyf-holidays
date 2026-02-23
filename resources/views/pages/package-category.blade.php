@extends('layouts.app')

@section('title', $category['name'] . ' - GYF Holidays')
@section('meta_description', $category['description'])
@section('meta_keywords', $category['name'] . ', ' . $category['name'] . ' Packages, B2B ' . $category['name'] . ' Tours, ' . $category['name'] . ' Destination Management')

@section('content')
    <x-hero
        :title="$category['name']"
        :subtitle="$category['description']"
        :backgroundImage="$category['image']"
        :showCTA="false"
        height="h-[400px]"
    />

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            @if($packages->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($packages as $pkg)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-shadow">
                            <a href="/package/{{ $pkg['id'] }}">
                                <div class="relative aspect-video overflow-hidden">
                                    <img
                                        src="{{ $pkg['image'] }}"
                                        alt="{{ $pkg['name'] }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    >
                                    <div class="absolute top-4 right-4 bg-primary-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $pkg['duration'] }}
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $pkg['name'] }}</h3>
                                    <p class="text-gray-600 mb-6 line-clamp-2">{{ $pkg['description'] }}</p>
                                    <div class="text-primary-600 font-bold flex items-center">
                                        View Details <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl shadow-inner border-2 border-dashed border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tour Packages Arriving Soon!</h3>
                    <p class="text-gray-600 max-w-md mx-auto">We are currently curating the best experiences for this region.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
