@extends('layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
    <!-- Hero Section -->
    <x-hero
        :title="$page->title"
        :subtitle="$page->meta_description"
        :backgroundImage="$page->category->image ?? 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?w=1920&auto=format&fit=crop&q=80'"
        :showCTA="false"
        height="h-[450px]"
    />

    <!-- Description Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="relative pl-12">
                    <div class="absolute left-0 top-0 w-1.5 h-full gradient-primary rounded-full opacity-20"></div>
                    <div class="absolute left-0 top-0 w-1.5 h-24 gradient-primary rounded-full"></div>
                    <p class="text-2xl text-gray-600 font-medium leading-relaxed italic">
                        "{{ $page->description }}"
                    </p>
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
                        <span>Top Destinations</span>
                    </div>
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">
                        Explore Our Best <span class="text-primary-600">Offers</span>
                    </h2>
                    <p class="text-gray-500 max-w-2xl mx-auto font-medium">
                        Handpicked tour packages for your B2B clients in this region.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($packages as $pkg)
                        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/30 overflow-hidden group hover:shadow-2xl transition-all duration-500 flex flex-col h-full border border-gray-100/50">
                            <div class="relative h-64 overflow-hidden">
                                <img
                                    src="{{ $pkg->image }}"
                                    alt="{{ $pkg->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
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

    <!-- CTA Section -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="bg-gray-900 rounded-[3.5rem] p-12 md:p-20 relative overflow-hidden flex flex-col lg:flex-row items-center gap-16">
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary-600/10 blur-[100px] rounded-full"></div>
                
                <div class="w-full lg:w-1/2 relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white mb-8 leading-tight tracking-tight">
                        Ready to partner with the best <span class="text-primary-500">DMC</span>?
                    </h2>
                    <p class="text-lg text-white/60 font-medium mb-10 leading-relaxed italic">
                        "We have a unique way of meeting your adventurous expectations! Our B2B approach ensures that your clients get the most out of their European journeys."
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
