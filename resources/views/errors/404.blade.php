<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Page Not Found | GYF Holidays</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Satisfy&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4 overflow-hidden relative">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-secondary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>

        <div class="max-w-xl w-full text-center relative z-10">
            <!-- 404 Text -->
            <h1 class="text-[120px] md:text-[180px] font-black leading-none text-primary-900/10 select-none">
                404
            </h1>
            
            <div class="-mt-12 md:-mt-20">
                <div class="flex flex-col items-center mb-8">
                    <div class="text-4xl font-bold mb-2">
                        <span class="gradient-primary bg-clip-text text-transparent uppercase">Lost </span>
                        <span class="text-secondary-600 uppercase">at Sea?</span>
                    </div>
                    <p style="font-family: 'Satisfy', cursive; font-style: italic; font-weight: 700; letter-spacing: 0.09em;" class="text-xl text-gray-600">Explore beyond the map</p>
                </div>

                <p class="text-gray-500 text-lg mb-10 leading-relaxed">
                    The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="/" class="w-full sm:w-auto px-8 py-4 gradient-primary text-white rounded-xl font-bold shadow-lg shadow-primary-600/20 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Back to Home
                    </a>
                    <a href="/contact" class="w-full sm:w-auto px-8 py-4 bg-white text-gray-700 border border-gray-200 rounded-xl font-bold hover:bg-gray-50 hover:border-primary-200 transition-all duration-300 flex items-center justify-center">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
    </style>
</body>
</html>
