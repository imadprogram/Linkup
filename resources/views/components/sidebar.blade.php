<div class="flex flex-col pt-6 gap-8">

    {{-- User Profile Card --}}
    <div class="flex flex-col items-center text-center">
        <div class="relative">
            {{-- Profile Image --}}
            <img src="{{ auth()->user()->pfp ? asset('storage/' . auth()->user()->pfp) : 'https://i.pravatar.cc/150?img=11' }}"
                alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-sm">
            {{-- Decorative dot/icon from design --}}
            <div class="absolute -top-1 -left-2 text-2xl text-purple-400">✦</div>
        </div>
        @auth
            <h2 class="mt-3 font-bold text-lg text-slate-900">{{ auth()->user()->name }}</h2>
            <p class="text-sm text-slate-400 font-medium">@ {{ auth()->user()->name }}{{ auth()->user()->id }}</p>
        @endauth
    </div>

    {{-- Navigation Menu --}}
    <nav class="flex flex-col gap-2">

        {{-- Active Item (News Feed) --}}
        <a href="/home"
            class="flex items-center gap-4 px-6 py-4 {{ request()->is('home') ? 'bg-black text-white rounded-2xl shadow-lg shadow-black/20 transition-transform hover:scale-[1.02]' : 'text-slate-600 hover:bg-white hover:text-red rounded-2xl transition-colors' }}">
            <i class="fa-solid fa-compass text-xl"></i>
            <span class="font-bold">News Feed</span>
        </a>

        {{-- Inactive Item (Messages) --}}
        <a href="#"
            class="flex items-center justify-between px-6 py-3 text-slate-600 hover:bg-white hover:text-black rounded-2xl transition-colors">
            <div class="flex items-center gap-4">
                <i class="fa-solid fa-envelope text-xl"></i>
                <span class="font-bold">Messages</span>
            </div>
            {{-- Notification Badge --}}
            <span class="bg-black text-white text-xs font-bold px-2 py-0.5 rounded-full">6</span>
        </a>

        {{-- Inactive Item (Forums) --}}
        <a href="#"
            class="flex items-center gap-4 px-6 py-3 text-slate-600 hover:bg-white hover:text-black rounded-2xl transition-colors">
            <i class="fa-solid fa-comments text-xl"></i>
            <span class="font-bold">Forums</span>
        </a>

        {{-- Inactive Item (Friends) --}}
        <a href="#"
            class="flex items-center justify-between px-6 py-3 text-slate-600 hover:bg-white hover:text-black rounded-2xl transition-colors">
            <div class="flex items-center gap-4">
                <i class="fa-solid fa-user-group text-xl"></i>
                <span class="font-bold">Friends</span>
            </div>
            <span class="bg-black text-white text-xs font-bold px-2 py-0.5 rounded-full">3</span>
        </a>

        {{-- Inactive Item (Media) --}}
        <a href="#"
            class="flex items-center gap-4 px-6 py-3 text-slate-600 hover:bg-white hover:text-black rounded-2xl transition-colors">
            <i class="fa-solid fa-image text-xl"></i>
            <span class="font-bold">Media</span>
        </a>

        {{-- Inactive Item (Settings) --}}
        <a href="/profile"
            class="flex items-center gap-4 px-6 py-3 {{ request()->is('profile') ? 'bg-black text-white rounded-2xl shadow-lg shadow-black/20 transition-transform hover:scale-[1.02]' : 'text-slate-600 hover:bg-white hover:text-red rounded-2xl transition-colors' }}">
            <i class="fa-solid fa-gear text-xl"></i>
            <span class="font-bold">Settings</span>
        </a>
    </nav>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="text-red-600 flex gap-4 px-6 py-3 rounded-2xl hover:bg-red-600 hover:text-white transition-colors transition-1s">
            <i class="fa-solid fa-right-from-bracket text-xl font-bold"></i> Logout
        </button>
    </form>
</div>
