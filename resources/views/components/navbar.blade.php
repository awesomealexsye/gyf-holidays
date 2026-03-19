@php
    $navLinks = [
        ['path' => '/', 'label' => 'Home'],
        ['path' => '/about', 'label' => 'About Us'],
        ['path' => '/services', 'label' => 'Services'],
        ['path' => '/destinations', 'label' => 'Destinations'],
        ['path' => '/coach-transportation', 'label' => 'Coach and Transportation'],
        ['path' => '/contact', 'label' => 'Contact Us'],
    ];
@endphp

<div x-data="{ isOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">
    <!-- Top Bar -->
    <div class="bg-primary-900 text-white py-2 hidden md:block">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-6">
                    <a href="tel:{{ config('gyf.contact.phone') }}" class="flex items-center space-x-2 hover:text-secondary-400 transition">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                        <span>{{ config('gyf.contact.phone') }}</span>
                    </a>
                    <a href="mailto:{{ config('gyf.contact.email') }}" class="flex items-center space-x-2 hover:text-secondary-400 transition">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                        <span>{{ config('gyf.contact.email') }}</span>
                    </a>
                </div>
                <div class="text-sm">
                    <span class="text-secondary-400 font-semibold">{{ config('gyf.company.tagline') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav
        class="sticky top-0 z-50 transition-all duration-300"
        :class="scrolled ? 'bg-white shadow-lg' : 'bg-white/95 backdrop-blur-sm'"
    >
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <!-- Logo -->
                <a href="/" class="flex flex-col">
                    <div class="text-3xl font-bold leading-tight">
                        <span class="gradient-primary bg-clip-text text-transparent">GYF</span>
                        <span class="text-secondary-600"> Holidays</span>
                    </div>
                    <p style="font-family: 'Satisfy', cursive; font-style: italic; font-weight: 700; letter-spacing: 0.09em; word-spacing: 0.2em" class="text-xs text-gray-600 mt-0.5 leading-tight">Explore beyond the map</p>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    @foreach($navLinks as $link)
                        <a
                            href="{{ $link['path'] }}"
                            class="px-4 py-2 rounded-lg font-medium transition-all {{ request()->is(ltrim($link['path'], '/')) || (request()->is('/') && $link['path'] == '/') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}"
                        >
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>

                <!-- CTA Button Desktop -->
                <div class="hidden lg:block">
                    <a
                        href="/contact"
                        class="px-6 py-3 gradient-primary text-white rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all"
                    >
                        Get Quote
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button
                    @click="isOpen = !isOpen"
                    class="lg:hidden text-gray-700 hover:text-primary-600 transition"
                    aria-label="Toggle navigation menu"
                >
                    <template x-if="isOpen">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </template>
                    <template x-if="!isOpen">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </template>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="lg:hidden bg-white border-t border-gray-200"
            @click.away="isOpen = false"
        >
            <div class="container mx-auto px-4 py-4 space-y-2">
                @foreach($navLinks as $link)
                    <a
                        href="{{ $link['path'] }}"
                        class="block px-4 py-3 rounded-lg font-medium transition-all {{ request()->is(ltrim($link['path'], '/')) || (request()->is('/') && $link['path'] == '/') ? 'text-primary-600 bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <a
                    href="/contact"
                    class="block px-4 py-3 gradient-primary text-white rounded-lg font-semibold text-center"
                >
                    Get Quote
                </a>
            </div>
        </div>
    </nav>
</div>
