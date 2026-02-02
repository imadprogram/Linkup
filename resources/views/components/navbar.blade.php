<div class="sticky top-0 z-10 mb-6">
    <div class="bg-white/80 backdrop-blur-md border border-white/20 shadow-sm rounded-2xl p-4 flex items-center justify-between gap-4">
        
        {{-- Search Form (Wraps the input area) --}}
        <form action="/search" method="GET" class="flex-1 relative group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
            </div>
            <input type="text" 
                name="search"
                class="block w-full pl-10 pr-3 py-2.5 bg-slate-100 border-none rounded-xl text-sm font-medium text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all shadow-inner" 
                placeholder="Search for people, posts, or tags...">
        </form>

        {{-- Right Actions --}}
        <div class="flex items-center gap-3">
            <button class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-500 hover:bg-slate-100 hover:text-indigo-600 transition-colors">
                <i class="fa-regular fa-bell text-lg"></i>
            </button>
            <a href="{{ route('new.post') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-black text-white hover:bg-slate-800 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

    </div>
</div>
