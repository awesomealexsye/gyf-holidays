@extends('layouts.app')

@section('title', $package['name'] . ' - GYF Holidays')
@section('meta_description', $package['description'])
@section('meta_keywords', $package['name'] . ', ' . $package['destination'] . ' tour, ' . $package['duration'] . ' trip, B2B ' . $package['destination'] . ' travel')

@section('content')
    <x-hero
        :title="$package['name']"
        :subtitle="$package['destination']"
        :backgroundImage="$package['image']"
        :showCTA="false"
        height="h-[450px]"
    />

    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-2/3 px-4">
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Tour Highlights</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
                        @foreach($package['highlights'] as $highlight)
                            <div class="flex items-start space-x-3">
                                <svg class="text-green-500 mt-1 flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span class="text-gray-700">{{ $highlight }}</span>
                            </div>
                        @endforeach
                    </div>

                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Detailed Itinerary</h2>
                    <div class="space-y-8">
                        @foreach($package['itinerary'] as $index => $item)
                            <div class="relative pl-12 pb-8 border-l-2 border-primary-200 last:border-0 last:pb-0">
                                <div class="absolute left-[-13px] top-0 w-6 h-6 rounded-full bg-primary-600 flex items-center justify-center text-white text-xs font-bold ring-4 ring-white">
                                    {{ $index + 1 }}
                                </div>
                                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100">
                                    <h4 class="text-sm font-bold text-primary-600 uppercase mb-1">{{ $item['day'] }}</h4>
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $item['title'] }}</h3>
                                    <p class="text-gray-600 leading-relaxed">{{ $item['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3 px-4">
                <div class="sticky top-32">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Interested in this trip?</h3>
                        <div class="space-y-4">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('gyf.contact.whatsapp')) }}" target="_blank" class="w-full py-4 bg-green-500 text-white rounded-xl font-bold flex items-center justify-center space-x-2">
                                <span>Inquiry on WhatsApp</span>
                            </a>
                            <a href="/contact" class="w-full py-4 bg-primary-600 text-white rounded-xl font-bold flex items-center justify-center">
                                <span>Contact For Booking</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
