<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - GYF Holidays</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-primary-950 font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="p-8 text-center bg-primary-900 text-white">
                    <h1 class="text-3xl font-bold tracking-wider">GYF ADMIN</h1>
                    <p class="text-primary-400 mt-2">Manage your B2B travel business</p>
                </div>
                
                <div class="p-8">
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 text-sm">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-600 focus:bg-white outline-none transition"
                                placeholder="admin@gyfholidays.com"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                required 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-600 focus:bg-white outline-none transition"
                                placeholder="••••••••"
                            >
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                        </div>
                        <button type="submit" class="w-full py-4 bg-primary-900 text-white rounded-xl font-bold hover:bg-primary-800 shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                            Login to Dashboard
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-center text-primary-400 mt-8 text-sm">
                &copy; {{ date('Y') }} GYF Holidays Admin Panel. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
