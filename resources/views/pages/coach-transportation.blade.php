@extends('layouts.app')

@section('title', 'Coach & Transfer Services - GYF Holidays | UK & Europe')
@section('meta_description', 'Premium standalone coach services across UK and Europe. Luxury coaches, executive minibuses, and premium vans for B2B partners and corporate planners.')
@section('meta_keywords', 'Coach Services Europe, UK Bus Hire B2B, Luxury Minibus Rental, European Group Transport, Chauffeur Services UK')

@section('content')
    <x-hero
        title="Coach & Transfer Services"
        subtitle="Global standards in luxury standalone coach services across the UK & Europe"
        backgroundImage="/pictures/coach-transportation/5.jpeg"
        :showCTA="false"
        height="h-[600px]"
    />

    <!-- Intro Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center mb-20">
                <div class="inline-flex items-center space-x-2 bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider mb-6">
                    <span>B2B Transport Excellence</span>
                </div>
                <h2 class="text-4xl md:text-6xl font-black text-gray-900 mb-8 leading-tight tracking-tight">
                    UK & Europe <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-600">Standalone</span> Coach Services
                </h2>
                <p class="text-xl text-gray-600 leading-relaxed font-medium max-w-3xl mx-auto">
                    At GYF Holidays, we specialize in providing reliable and luxury standalone coach services across the UK & Europe for travel agents, tour operators, and corporate planners.
                </p>
            </div>
        </div>
    </section>

    <!-- Fleet Options -->
    @php
        $fleetOptions = [
            [
                'title' => 'Luxury Coaches',
                'capacity' => '20 – 48 Seater',
                'description' => 'Ideal for group tours, student groups, leisure series & MICE movements.',
                'image' => '/pictures/coach-transportation/1.jpeg',
            ],
            [
                'title' => 'Executive Minibus',
                'capacity' => 'Up to 15 Seater',
                'description' => 'Perfect for small groups, FIT movements & corporate travel.',
                'image' => '/pictures/coach-transportation/5.jpeg',
            ],
            [
                'title' => 'Premium Vans',
                'capacity' => 'Mercedes Sprinter / Premium Vans',
                'description' => 'Luxury family travel, VIP movements & executive transfers.',
                'image' => '/pictures/coach-transportation/3.jpeg',
            ]
        ];
    @endphp

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tighter">Our Fleet Options</h2>
                <p class="text-xl text-gray-500 max-w-2xl mx-auto font-medium">
                    We offer a wide range of modern, well-maintained vehicles operated by professional, licensed chauffeurs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($fleetOptions as $fleet)
                    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl group flex flex-col h-full">
                        <div class="h-72 overflow-hidden relative">
                            <img
                                src="@webp($fleet['image'])"
                                alt="{{ $fleet['title'] }} - Coach Transportation by GYF Holidays"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                loading="lazy"
                            >
                            <div class="absolute top-6 right-6 bg-white/95 px-5 py-2 rounded-2xl text-xs font-black text-primary-600 shadow-xl">
                                {{ $fleet['capacity'] }}
                            </div>
                        </div>
                        <div class="p-10 flex-grow flex flex-col">
                            <h3 class="text-2xl font-black text-gray-900 mb-4 group-hover:text-primary-600 transition-colors">{{ $fleet['title'] }}</h3>
                            <p class="text-gray-600 mb-8 text-sm leading-relaxed font-medium">{{ $fleet['description'] }}</p>
                            <div class="mt-auto flex items-center p-4 bg-primary-50 rounded-2xl border border-primary-100 group-hover:bg-primary-600 transition-colors group-hover:text-white">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                <span class="font-black text-sm">Professional Chauffeurs</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modern CTA -->
    <section class="py-24 px-4">
        <div class="container mx-auto max-w-6xl">
            <div class="relative bg-gray-900 rounded-[3.5rem] p-12 md:p-24 overflow-hidden text-center text-white">
                <h2 class="text-4xl md:text-7xl font-black mb-10 tracking-tighter leading-none">
                    Contact Us for Special <span class="text-primary-500">B2B Rates</span>
                </h2>
                <div class="text-white/80 text-lg mb-14 max-w-2xl mx-auto font-medium leading-loose">
                    <p>📧 {{ config('gyf.contact.salesEmail') }}</p>
                    <p>📞 {{ config('gyf.contact.phone') }}</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-8 w-full max-w-md mx-auto">
                    <a
                        href="/contact"
                        class="flex-1 px-10 py-6 bg-white text-gray-950 rounded-2xl font-black text-lg hover:bg-white/90 transform active:scale-95 transition-all shadow-2xl"
                    >
                        Get a Quote
                    </a>
                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('gyf.contact.whatsapp')) }}"
                        class="flex-1 px-10 py-6 bg-primary-600 text-white rounded-2xl font-black text-lg hover:bg-primary-700 transform active:scale-95 transition-all shadow-2xl"
                    >
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
