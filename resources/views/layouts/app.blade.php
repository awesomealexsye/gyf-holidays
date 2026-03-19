<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <title>@yield('title', 'GYF Holidays - Your Trusted B2B Travel Partner')</title>
    <meta name="description" content="@yield('meta_description', 'GYF Holidays offers premium B2B travel and tour packages for corporate clients, group bookings, and customized holiday trips worldwide.')">
    <meta name="keywords" content="@yield('meta_keywords', 'GYF Holidays, B2B Travel, Corporate Travel, Group Bookings, Europe Tour Packages, UK Travel, Scandinavia Tours')">
    <meta name="author" content="GYF Holidays">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'GYF Holidays - Your Trusted B2B Travel Partner')">
    <meta property="og:description" content="@yield('meta_description', 'GYF Holidays offers premium B2B travel and tour packages for corporate clients, group bookings, and customized holiday trips worldwide.')">
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @else
        <meta property="og:image" content="{{ asset('logo.png') }}">
    @endif

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'GYF Holidays - Your Trusted B2B Travel Partner')">
    <meta property="twitter:description" content="@yield('meta_description', 'GYF Holidays offers premium B2B travel and tour packages for corporate clients, group bookings, and customized holiday trips worldwide.')">
    @hasSection('og_image')
        <meta property="twitter:image" content="@yield('og_image')">
    @else
        <meta property="twitter:image" content="{{ asset('logo.png') }}">
    @endif

    @yield('meta_tags')

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Preload only the critical font weights used above the fold --}}
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLCz7Z1xlFd2JQEk.woff2" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/poppins/v24/pxiEyp8kv8JHgFVrJJfecnFHGPc.woff2" crossorigin>
    {{-- Load fonts non-render-blocking with display=swap --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Satisfy&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Satisfy&display=swap" rel="stylesheet"></noscript>

    @yield('preload')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="google-site-verification" content="bcuU-VxvQ1OefDYM1Teq0xYF35ir6zrTWG0Vg_gy9pI" />
    <!-- Google tag (gtag.js) - deferred to improve mobile performance -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-7R0P5T50GJ');

        // Load GTM after page becomes interactive
        if (typeof requestIdleCallback === 'function') {
            requestIdleCallback(function() {
                var s = document.createElement('script');
                s.src = 'https://www.googletagmanager.com/gtag/js?id=G-7R0P5T50GJ';
                s.async = true;
                document.head.appendChild(s);
            });
        } else {
            window.addEventListener('load', function() {
                setTimeout(function() {
                    var s = document.createElement('script');
                    s.src = 'https://www.googletagmanager.com/gtag/js?id=G-7R0P5T50GJ';
                    s.async = true;
                    document.head.appendChild(s);
                }, 2000);
            });
        }
    </script>

    <!-- Organization Schema (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "TravelAgency",
        "name": "{{ config('gyf.company.name') }}",
        "alternateName": "{{ config('gyf.company.fullName') }}",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('logo.png') }}",
        "description": "{{ config('gyf.company.description') }}",
        "foundingDate": "{{ config('gyf.company.foundedYear') }}",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ config('gyf.contact.address.street') }}",
            "addressLocality": "{{ config('gyf.contact.address.city') }}",
            "addressRegion": "{{ config('gyf.contact.address.state') }}",
            "postalCode": "{{ config('gyf.contact.address.zip') }}",
            "addressCountry": "IN"
        },
        "telephone": "{{ config('gyf.contact.phone') }}",
        "email": "{{ config('gyf.contact.email') }}",
        "sameAs": [
            "{{ config('gyf.social.facebook') }}",
            "{{ config('gyf.social.instagram') }}",
            "{{ config('gyf.social.youtube') }}"
        ],
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "opens": "10:00",
            "closes": "19:00"
        },
        "areaServed": {
            "@type": "Country",
            "name": "India"
        },
        "serviceType": ["B2B Travel", "DMC Services", "Europe Tour Packages", "Scandinavia Tours", "UK Tours", "Corporate Travel"]
    }
    </script>

    @stack('schema')
</head>

<body class="font-sans antialiased min-h-screen flex flex-col bg-gray-50">
    <x-navbar />

    <main class="flex-grow">
        @yield('content')
    </main>

    <x-footer />

    <x-whatsapp-button />
    <x-scroll-to-top />

    @stack('scripts')
</body>

</html>