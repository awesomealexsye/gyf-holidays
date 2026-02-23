@php
    $steps = [
        [
            'icon' => '<svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path></svg>',
            'title' => 'Preparation',
            'description' => 'Receive your personalized itinerary, travel documents, and expert tips for a smooth departure.',
            'details' => ['Itinerary Finalization', 'Packing Guide']
        ],
        [
            'icon' => '<svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path></svg>',
            'title' => 'The Experience',
            'description' => 'Immerse yourself in carefully curated tours with 24/7 on-ground support and seamless logistics.',
            'details' => ['Private Transfers', 'Guided Tours', '24/7 Support']
        ],
        [
            'icon' => '<svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>',
            'title' => 'Homecoming',
            'description' => 'Return with unforgettable memories and shared stories from your bespoke travel experience.',
            'details' => ['Feedback Session', 'Photo Sharing', 'Future Planning']
        ]
    ];
@endphp

<section class="py-24 bg-gray-50 overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 font-primary">
                Your Journey with {{ config('gyf.company.name') }}
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                From the first consultation to your safe return, we ensure every moment is perfectly orchestrated.
            </p>
        </div>

        <div class="relative max-w-5xl mx-auto">
            <!-- Connection Line -->
            <div class="hidden md:block absolute top-[60px] left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-primary-200 via-primary-500 to-primary-200 z-0"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                @foreach($steps as $index => $step)
                    <div class="group">
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mb-8 shadow-xl border-4 border-gray-100 group-hover:border-primary-500 transition-all duration-500 transform group-hover:scale-110 relative">
                                <div class="text-primary-600 transition-colors duration-500">
                                    {!! $step['icon'] !!}
                                </div>
                                <div class="absolute -top-2 -right-2 w-10 h-10 bg-primary-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ $index + 1 }}
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">
                                {{ $step['title'] }}
                            </h3>
                            <p class="text-gray-600 text-center mb-8 px-4 leading-relaxed italic">
                                {{ $step['description'] }}
                            </p>

                            <div class="w-full space-y-3">
                                @foreach($step['details'] as $detail)
                                    <div class="flex items-center space-x-3 bg-white p-3 rounded-xl shadow-sm border border-gray-100 group-hover:shadow-md transition-shadow">
                                        <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                                        <span class="text-sm font-semibold text-gray-700">{{ $detail }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
