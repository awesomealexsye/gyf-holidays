@php
    $processSteps = [
        [
            'number' => '01',
            'title' => 'Inquiry',
            'description' => 'Share your travel requirements with us',
        ],
        [
            'number' => '02',
            'title' => 'Consultation',
            'description' => 'Our experts discuss options and customize solutions',
        ],
        [
            'number' => '03',
            'title' => 'Proposal',
            'description' => 'Receive detailed itinerary and pricing',
        ],
        [
            'number' => '04',
            'title' => 'Booking',
            'description' => 'Confirm and finalize your travel arrangements',
        ],
        [
            'number' => '05',
            'title' => 'Support',
            'description' => 'Enjoy 24/7 assistance throughout your journey',
        ],
    ];
@endphp

<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Our Process
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Simple, transparent, and efficient - here's how we work
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            @foreach($processSteps as $index => $step)
                <div class="relative text-center">
                    <div class="mb-6 relative">
                        <div class="w-20 h-20 bg-primary-600 rounded-full flex items-center justify-center mx-auto text-white text-2xl font-bold relative z-10 shadow-lg">
                            {{ $step['number'] }}
                        </div>
                        @if($index < count($processSteps) - 1)
                            <div class="hidden md:block absolute top-10 left-[60%] w-[80%] h-0.5 bg-primary-200 z-0"></div>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-gray-600">{{ $step['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
