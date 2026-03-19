@extends('layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('og_image', \App\Helpers\ImageHelper::webp($page->category->image ?? asset('logo.png')))

@push('schema')
    <!-- BreadcrumbList Schema -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Services",
                "item": "{{ url('/services') }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $page->title }}",
                "item": "{{ url($page->slug) }}"
            }
        ]
    }
    </script>

    <!-- Service Schema for this DMC page -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "Service",
        "name": "{{ $page->title }}",
        "description": "{{ $page->meta_description }}",
        "provider": {
            "@type": "TravelAgency",
            "name": "{{ config('gyf.company.name') }}",
            "url": "{{ config('app.url') }}",
            "telephone": "{{ config('gyf.contact.phone') }}",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ config('gyf.contact.address.street') }}",
                "addressLocality": "{{ config('gyf.contact.address.city') }}",
                "addressRegion": "{{ config('gyf.contact.address.state') }}",
                "postalCode": "{{ config('gyf.contact.address.zip') }}",
                "addressCountry": "IN"
            }
        },
        "areaServed": {
            "@type": "City",
            "name": "{{ $page->city }}"
        },
        "serviceType": "B2B DMC Services"
    }
    </script>

    @if($page->faqs && count($page->faqs) > 0)
    <!-- FAQPage Schema -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            @foreach($page->faqs as $index => $faq)
            {
                "@type": "Question",
                "name": "{{ $faq['question'] }}",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $faq['answer'] }}"
                }
            }@if(!$loop->last),@endif
            @endforeach
        ]
    }
    </script>
    @endif
@endpush

@section('content')
    <!-- Hero Section -->
    <x-hero
        :title="$page->title"
        :subtitle="$page->meta_description"
        :backgroundImage="$page->category->image ?? 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=1920&auto=format&fit=crop&q=80'"
        :showCTA="false"
        height="h-[450px]"
    />

    <!-- Breadcrumb Navigation -->
    <nav class="bg-white border-b border-gray-100" aria-label="Breadcrumb">
        <div class="container mx-auto px-4 py-3">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-primary-600 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="{{ url('/services') }}" class="ml-2 hover:text-primary-600 transition">Services</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-2 text-gray-900 font-semibold">{{ $page->title }}</span>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Main Content Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Section 1: About Our Services in This City -->
                <div class="mb-16">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-6 tracking-tight">
                        About Our {{ $page->region }} DMC Services in {{ $page->city }}
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        <p>{{ $page->description }}</p>
                    </div>
                </div>

                @if($page->city_specific_content)
                <!-- Section 2: City-Specific Content -->
                <div class="mb-16">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-6 tracking-tight">
                        Why Travel Agents in {{ $page->city }} Choose GYF Holidays
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($page->city_specific_content)) !!}
                    </div>
                </div>
                @endif

                <!-- Section 3: Why Choose Us - Trust Signals -->
                <div class="mb-16">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-8 tracking-tight">
                        Why Choose GYF Holidays as Your {{ $page->region }} DMC Partner
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start space-x-4 p-6 bg-gray-50 rounded-2xl">
                            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">{{ config('gyf.stats.yearsExperience') }}+ Years of B2B Expertise</h3>
                                <p class="text-gray-500 text-sm">Trusted by {{ config('gyf.stats.happyClients') }}+ travel agents across India for reliable {{ $page->region }} tour packages.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-6 bg-gray-50 rounded-2xl">
                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Best B2B Rates Guaranteed</h3>
                                <p class="text-gray-500 text-sm">Competitive wholesale pricing with high margins for travel agents in {{ $page->city }}.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-6 bg-gray-50 rounded-2xl">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">{{ config('gyf.stats.destinations') }}+ {{ $page->region }} Destinations</h3>
                                <p class="text-gray-500 text-sm">Comprehensive coverage across {{ $page->region }} with customizable itineraries for every budget.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-6 bg-gray-50 rounded-2xl">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">24/7 On-Ground Support</h3>
                                <p class="text-gray-500 text-sm">Round-the-clock assistance with dedicated support for travel agents and their clients during the tour.</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($page->seo_content)
                <!-- Section 4: Additional SEO Content -->
                <div class="mb-16">
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($page->seo_content)) !!}
                    </div>
                </div>
                @endif

                <!-- Section 5: How Our B2B DMC Model Works -->
                <div class="mb-16">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-8 tracking-tight">
                        How Our B2B DMC Model Works for {{ $page->city }} Agents
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="text-center p-6">
                            <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-black text-primary-600">1</span>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Enquiry</h3>
                            <p class="text-gray-500 text-sm">Share your client requirements - group size, destinations, budget, and travel dates.</p>
                        </div>
                        <div class="text-center p-6">
                            <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-black text-primary-600">2</span>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Custom Itinerary</h3>
                            <p class="text-gray-500 text-sm">We design a tailored {{ $page->region }} itinerary with the best hotels, transfers, and experiences.</p>
                        </div>
                        <div class="text-center p-6">
                            <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-black text-primary-600">3</span>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Confirmation</h3>
                            <p class="text-gray-500 text-sm">Review, approve, and confirm the package with transparent B2B pricing.</p>
                        </div>
                        <div class="text-center p-6">
                            <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-black text-primary-600">4</span>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Travel & Support</h3>
                            <p class="text-gray-500 text-sm">Your clients enjoy the trip with our 24/7 on-ground support across {{ $page->region }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section (Top Destinations) -->
    @if($packages->count() > 0)
        <section class="py-24 bg-gray-50/50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center space-x-2 bg-primary-100 text-primary-600 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider mb-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        <span>Top {{ $page->region }} Destinations</span>
                    </div>
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">
                        Best {{ $page->region }} Tour Packages for <span class="text-primary-600">{{ $page->city }}</span> Travel Agents
                    </h2>
                    <p class="text-gray-500 max-w-2xl mx-auto font-medium">
                        Handpicked {{ $page->region }} tour packages with competitive B2B rates for travel agents in {{ $page->city }}.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($packages as $pkg)
                        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/30 overflow-hidden group hover:shadow-2xl transition-all duration-500 flex flex-col h-full border border-gray-100/50">
                            <div class="relative h-64 overflow-hidden">
                                <img
                                    src="@webp($pkg->image)"
                                    alt="{{ $pkg->name }} - {{ $page->region }} Tour Package for {{ $page->city }} Travel Agents"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                                    loading="lazy"
                                >
                                <div class="absolute top-6 right-6 bg-white/95 backdrop-blur px-4 py-2 rounded-2xl text-xs font-black text-primary-600 shadow-xl border border-primary-50">
                                    {{ $pkg->duration }}
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/80 to-transparent">
                                    <div class="flex items-center text-white/90 text-xs font-bold uppercase tracking-widest">
                                        <svg class="w-3 h-3 mr-2 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $pkg->destination }}
                                    </div>
                                </div>
                            </div>

                            <div class="p-8 flex-grow flex flex-col">
                                <h3 class="text-xl font-black text-gray-900 mb-4 leading-tight group-hover:text-primary-600 transition-colors">
                                    {{ $pkg->name }}
                                </h3>

                                <div class="space-y-3 mb-8">
                                    @foreach(collect($pkg->highlights)->take(3) as $highlight)
                                        <div class="flex items-start text-sm text-gray-500 font-bold tracking-tight leading-snug group/item">
                                            <div class="w-5 h-5 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0 mr-3 group-hover/item:bg-green-500 transition-colors">
                                                <svg class="w-3 h-3 text-green-500 group-hover/item:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            {{ $highlight }}
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-auto pt-6 border-t border-gray-50">
                                    <a href="/package/{{ $pkg->id }}" class="flex items-center justify-between w-full px-6 py-4 bg-primary-600 text-white rounded-2xl font-black text-sm shadow-lg shadow-primary-600/20 hover:bg-primary-700 hover:-translate-y-0.5 transition-all duration-300 group/btn">
                                        <span>View Details</span>
                                        <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- FAQ Section -->
    @if($page->faqs && count($page->faqs) > 0)
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-4 tracking-tight">
                            Frequently Asked Questions
                        </h2>
                        <p class="text-gray-500 font-medium">
                            Common questions about {{ $page->region }} B2B DMC services for {{ $page->city }} travel agents.
                        </p>
                    </div>

                    <div class="space-y-4" x-data="{ openFaq: null }">
                        @foreach($page->faqs as $index => $faq)
                            <div class="bg-gray-50 rounded-2xl overflow-hidden border border-gray-100">
                                <button
                                    @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                                    class="w-full flex items-center justify-between p-6 text-left"
                                >
                                    <h3 class="font-bold text-gray-900 pr-4">{{ $faq['question'] }}</h3>
                                    <svg
                                        class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-300"
                                        :class="{ 'rotate-180': openFaq === {{ $index }} }"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div
                                    x-show="openFaq === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="px-6 pb-6"
                                >
                                    <p class="text-gray-600 leading-relaxed">{{ $faq['answer'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Related Pages Section (Internal Linking) -->
    @if(isset($relatedPages) && $relatedPages->count() > 0)
        <section class="py-16 bg-gray-50/50">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-2xl font-black text-gray-900 mb-8 tracking-tight">
                        Explore More B2B DMC Services
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($relatedPages as $related)
                            <a href="{{ url($related->slug) }}" class="block p-5 bg-white rounded-2xl border border-gray-100 hover:border-primary-200 hover:shadow-lg transition-all duration-300 group">
                                <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors mb-1">
                                    {{ $related->title }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ Str::limit($related->meta_description, 80) }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="bg-gray-900 rounded-[3.5rem] p-12 md:p-20 relative overflow-hidden flex flex-col lg:flex-row items-center gap-16">
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary-600/10 blur-[100px] rounded-full"></div>

                <div class="w-full lg:w-1/2 relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white mb-8 leading-tight tracking-tight">
                        Ready to partner with the best <span class="text-primary-500">{{ $page->region }} DMC</span> in {{ $page->city }}?
                    </h2>
                    <p class="text-lg text-white/60 font-medium mb-10 leading-relaxed">
                        Get exclusive B2B rates and customized {{ $page->region }} tour packages for your travel agency in {{ $page->city }}. Our dedicated team is ready to help you grow your business.
                    </p>
                    <div class="flex items-center space-x-8">
                        <div class="flex flex-col">
                            <span class="text-4xl font-black text-white">100%</span>
                            <span class="text-[10px] font-black text-primary-400 uppercase tracking-[0.2em]">Reliability</span>
                        </div>
                        <div class="w-px h-12 bg-white/10"></div>
                        <div class="flex flex-col">
                            <span class="text-4xl font-black text-white">24/7</span>
                            <span class="text-[10px] font-black text-primary-400 uppercase tracking-[0.2em]">Support</span>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 relative z-10">
                    <x-contact-form title="Request B2B Quote" :compact="true" />
                </div>
            </div>
        </div>
    </section>
@endsection
