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
                                    <p class="text-sm font-bold text-primary-600 uppercase mb-1">{{ $item['day'] }}</p>
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
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('gyf.contact.whatsapp')) }}" target="_blank" class="w-full py-4 bg-green-700 text-white rounded-xl font-bold flex items-center justify-center space-x-2" aria-label="Inquiry on WhatsApp">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
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
