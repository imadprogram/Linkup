<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Linkup</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Animation Styles --}}
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
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</head>

<body class="bg-gray-50 font-poppins text-slate-800 antialiased relative min-h-screen flex items-center justify-center overflow-hidden py-10">

    {{-- 1. Animated Background Blobs --}}
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob -z-10"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000 -z-10"></div>
    <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-pink-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000 -z-10"></div>

    {{-- 2. Glassmorphism Register Card --}}
    <div class="relative w-full max-w-md p-8 bg-white/70 backdrop-blur-xl border border-white/50 rounded-2xl shadow-2xl mx-4">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <a href="/" class="text-3xl font-bold tracking-tighter text-blue-600 hover:text-blue-700 transition inline-block mb-2">
                Linkup<span class="text-slate-900">.</span>
            </a>
            <h2 class="text-xl font-semibold text-slate-700">Create Account</h2>
            <p class="text-sm text-slate-500 mt-1">Join our virtual world today.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    class="w-full px-4 py-3 rounded-lg bg-white border border-gray-200 text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400 shadow-sm"
                    placeholder="John Doe">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                    class="w-full px-4 py-3 rounded-lg bg-white border border-gray-200 text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400 shadow-sm"
                    placeholder="name@example.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-lg bg-white border border-gray-200 text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400 shadow-sm"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-lg bg-white border border-gray-200 text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400 shadow-sm"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" 
                class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                Create Account
            </button>
        </form>

        {{-- Footer Link --}}
        <div class="mt-6 text-center text-sm text-slate-500">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">
                Log in
            </a>
        </div>
    </div>

</body>
</html>