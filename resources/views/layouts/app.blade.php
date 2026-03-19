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
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'GYF Holidays - Your Trusted B2B Travel Partner')">
    <meta property="og:description" content="@yield('meta_description', 'GYF Holidays offers premium B2B travel and tour packages for corporate clients, group bookings, and customized holiday trips worldwide.')">
    <meta property="og:image" content="{{ asset('logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'GYF Holidays - Your Trusted B2B Travel Partner')">
    <meta property="twitter:description" content="@yield('meta_description', 'GYF Holidays offers premium B2B travel and tour packages for corporate clients, group bookings, and customized holiday trips worldwide.')">
    <meta property="twitter:image" content="{{ asset('logo.png') }}">

    @yield('meta_tags')

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Satisfy&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y97N5KV1L6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Y97N5KV1L6');
    </script>
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