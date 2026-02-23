<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GYF Holidays</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false, logoutModal: false }">
    <div class="flex h-screen overflow-hidden bg-gray-100">
        <!-- Logout Confirmation Modal -->
        <div 
            x-show="logoutModal" 
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
        >
            <div 
                @click.away="logoutModal = false"
                class="bg-white rounded-[2rem] shadow-2xl max-w-sm w-full overflow-hidden transform transition-all"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
            >
                <div class="p-8 text-center">
                    <div class="w-20 h-20 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-2">Wait a moment!</h3>
                    <p class="text-gray-500 font-medium">Are you sure you want to end your current session and logout?</p>
                </div>
                <div class="flex border-t border-gray-100">
                    <button @click="logoutModal = false" class="flex-1 px-6 py-4 text-sm font-bold text-gray-500 hover:bg-gray-50 transition-colors border-r border-gray-100">
                        Cancel
                    </button>
                    <form action="{{ route('admin.logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full px-6 py-4 text-sm font-bold text-red-600 hover:bg-red-50 transition-colors">
                            Yes, Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Overlay (Mobile) -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-20 bg-black opacity-50 lg:hidden"
            x-cloak
        ></div>

        <!-- Sidebar -->
        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-primary-900 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex items-center justify-center py-6 bg-primary-950">
                <div class="text-center">
                    <span class="text-2xl font-bold text-white uppercase tracking-widest">GYF Admin</span>
                    <p class="text-[10px] text-primary-400 font-bold tracking-tighter uppercase mt-1">Holidays B2B Dashboard</p>
                </div>
            </div>

            <nav class="mt-6 px-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/50' : 'text-primary-100 hover:bg-primary-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.enquiries') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.enquiries*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/50' : 'text-primary-100 hover:bg-primary-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span class="font-medium">Enquiries</span>
                </a>

                <a href="{{ route('admin.pages') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.pages*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-900/50' : 'text-primary-100 hover:bg-primary-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="font-medium">SEO Pages</span>
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-[10px] font-bold text-primary-400 uppercase tracking-widest">External</p>
                </div>

                <a href="/" target="_blank" class="flex items-center px-4 py-3 text-primary-100 rounded-xl transition-all duration-200 hover:bg-primary-800 hover:text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <span class="font-medium">View Website</span>
                </a>
            </nav>

            <div class="absolute bottom-0 w-full p-4">
                <button @click="logoutModal = true" class="flex items-center justify-center w-full px-4 py-3 text-red-100 bg-red-600/20 hover:bg-red-600 rounded-xl transition-all duration-200 group">
                    <svg class="w-5 h-5 mr-3 text-red-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="font-bold">Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="flex items-center justify-between px-8 py-4 bg-white shadow-sm z-10">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-xl font-bold text-gray-800 tracking-tight">@yield('page_title')</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 mt-1">Administrator</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1e3a8a&color=fff&bold=true" class="w-10 h-10 rounded-xl shadow-inner border border-gray-100" alt="Avatar">
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100/50 p-8">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-500 text-white rounded-2xl shadow-lg shadow-green-500/20 flex items-center animate-fade-in">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
