@props([
    'title',
    'subtitle' => null,
    'backgroundImage' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1920&auto=format&fit=crop&q=80',
    'showCTA' => true,
    'height' => 'h-[600px]'
])

<div class="relative {{ $height }} flex items-center justify-center overflow-hidden">
    <!-- Background Image with Overlay -->
    <div
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('{{ $backgroundImage }}')"
    >
        <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 to-secondary-900/80"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 text-center">
        <div
            x-data
            x-init="gsap.from($el, { opacity: 0, y: 30, duration: 0.8 })"
        >
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                {{ $title }}
            </h1>
            @if($subtitle)
                <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
                    {{ $subtitle }}
                </p>
            @endif
            @if($showCTA)
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a
                        href="/contact"
                        class="px-8 py-4 bg-secondary-500 text-white rounded-lg font-semibold hover:bg-secondary-600 transform hover:-translate-y-1 transition-all shadow-lg"
                    >
                        Get Started
                    </a>
                    <a
                        href="/destinations"
                        class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-lg font-semibold hover:bg-white/20 border-2 border-white transition-all"
                    >
                        Explore Destinations
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                fill="white"
            />
        </svg>
    </div>
</div>
