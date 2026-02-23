<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title', 'GYF Holidays - Your Trusted B2B Travel Partner')</title>
    <meta name="description" content="@yield('meta_description', 'GYF Holidays offers premium B2B travel and tour packages for corporate clients, group bookings, and customized holiday trips worldwide.')">
    
    @yield('meta_tags')

    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Satisfy&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
