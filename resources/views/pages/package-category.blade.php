@extends('layouts.app')

@section('title', $category['name'] . ' Tour Packages - GYF Holidays B2B DMC')
@section('meta_description', 'Explore ' . $category['name'] . ' tour packages for B2B travel agents. GYF Holidays offers competitive wholesale rates on ' . $packages->count() . '+ curated ' . $category['name'] . ' itineraries with 24/7 on-ground support.')
@section('meta_keywords', $category['name'] . ', ' . $category['name'] . ' Packages, B2B ' . $category['name'] . ' Tours, ' . $category['name'] . ' Destination Management, ' . $category['name'] . ' DMC')
@section('og_image', \App\Helpers\ImageHelper::webp($category['image']))

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
                <div class="text-center mb-14">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Popular {{ $category['name'] }} Tour Packages
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Choose from {{ $packages->count() }} handpicked {{ $category['name'] }} itineraries designed for B2B travel agents with competitive wholesale rates.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($packages as $pkg)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-shadow">
                            <a href="/package/{{ $pkg['id'] }}">
                                <div class="relative aspect-video overflow-hidden">
                                    <img
                                        src="@webp($pkg['image'])"
                                        alt="{{ $pkg['name'] }} - {{ $category['name'] ?? 'Tour Package' }} by GYF Holidays"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        loading="lazy"
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

                <!-- Why Choose Section -->
                <div class="mt-20 max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                        Why Book {{ $category['name'] }} Packages with GYF Holidays
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                            <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Best B2B Rates</h3>
                            <p class="text-gray-500 text-sm">Competitive wholesale pricing with high margins for travel agents.</p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Fully Customizable</h3>
                            <p class="text-gray-500 text-sm">Every itinerary can be tailored to your client's preferences and budget.</p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-xl shadow-sm">
                            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">24/7 On-Ground Support</h3>
                            <p class="text-gray-500 text-sm">Round-the-clock assistance for your clients throughout the tour.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl shadow-inner border-2 border-dashed border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Tour Packages Arriving Soon!</h2>
                    <p class="text-gray-600 max-w-md mx-auto">We are currently curating the best experiences for this region.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
