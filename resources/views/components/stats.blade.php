@php
    $stats = [
        ['value' => '150+', 'label' => 'DESTINATIONS'],
        ['value' => '5000+', 'label' => 'HAPPY CLIENTS'],
        ['value' => '200+', 'label' => 'B2B PARTNERS'],
        ['value' => '50+', 'label' => 'EXPERTS'],
    ];
@endphp

<div class="container mx-auto px-4 relative z-10 -mt-10">
    <div 
        class="bg-white rounded-3xl shadow-xl py-8 px-4 grid grid-cols-2 md:grid-cols-4 gap-8"
    >
        @foreach($stats as $index => $stat)
            <div class="text-center {{ $index !== count($stats) - 1 ? 'md:border-r md:border-gray-100' : '' }}">
                <h3 class="text-3xl md:text-4xl font-black text-gray-900 mb-2 font-poppins">{{ $stat['value'] }}</h3>
                <p class="text-xs md:text-sm font-bold text-gray-400 tracking-widest uppercase">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>
</div>
