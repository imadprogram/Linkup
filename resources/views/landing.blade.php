<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/559afa4763.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body
    class="bg-gray-50 text-slate-800 font-poppins antialiased selection:bg-blue-500 selection:text-white relative overflow-x-hidden">

    {{-- 1. Modern Glassmorphism Navbar --}}
    <header
        class="fixed top-0 w-full z-50 transition-all duration-300 bg-white/70 backdrop-blur-lg border-b border-gray-100">
        @if (Route::has('login'))
            <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
                {{-- Logo --}}
                <a href="/"
                    class="text-2xl font-bold tracking-tighter text-blue-600 hover:text-blue-700 transition">
                    Linkup<span class="text-slate-900">.</span>
                </a>

                {{-- Auth Buttons --}}
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/home  ') }}"
                            class="font-medium text-sm text-slate-600 hover:text-blue-600 transition">
                            Open Linkup
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-medium text-sm text-slate-600 hover:text-slate-900 transition">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-5 py-2.5 text-sm font-semibold text-white bg-slate-900 rounded-full hover:bg-slate-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif
    </header>

    {{-- 2. Hero Section --}}
    <section class="relative h-screen w-full flex flex-col justify-center items-center text-center px-4 pt-16">

        {{-- Background Gradient Blobs (Pure Tailwind) --}}
        <div
            class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob -z-10">
        </div>
        <div
            class="absolute top-1/3 right-1/4 w-96 h-96 bg-purple-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000 -z-10">
        </div>
        <div
            class="absolute -bottom-8 left-1/2 w-96 h-96 bg-pink-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000 -z-10">
        </div>

        {{-- Main Content --}}
        <div class="relative z-10 max-w-4xl mx-auto space-y-8">

            {{-- Small Tagline --}}
            <span
                class="inline-block py-1 px-3 rounded-full bg-blue-50 text-blue-600 text-xs font-bold tracking-wider uppercase mb-4 border border-blue-100">
                The Future of Social
            </span>

            {{-- Headline --}}
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-[1.15] text-slate-900">
                Welcome to this <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Virtual
                    World</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Where you find friends, build connections, and discover a version of
                <span class="font-bold text-slate-800">yourself</span> you never knew existed.
            </p>

            {{-- Custom Styled CTA Button --}}
            <div class="pt-4">
                <button
                    class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white transition-all duration-200 bg-blue-600 rounded-full hover:bg-blue-700 hover:shadow-xl hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                    <span>Go Ahead</span>
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>

                    {{-- Button Glow Effect --}}
                    <div class="absolute inset-0 rounded-full ring-2 ring-white/20 group-hover:ring-white/40"></div>
                </button>
            </div>

        </div>
    </section>

    {{-- Optional: Add this animation keyframe to your tailwind.config.js or style tag for the blobs to move --}}
    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
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
</body>

</html>
