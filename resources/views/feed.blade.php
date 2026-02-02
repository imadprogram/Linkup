@extends('layouts.app')

@section('content')

    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900">Feeds</h1>

        {{-- Subtle "Filter" links from image --}}
        <div class="flex gap-4 text-sm font-semibold">
            <a href="#" class="text-slate-400 hover:text-black transition">Recents</a>
            <a href="#" class="text-black">Friends</a>
            <a href="#" class="text-slate-400 hover:text-black transition">Popular</a>
        </div>
    </div>

    {{-- Content Placeholder --}}
    <div class="flex flex-col gap-5">
        @foreach($posts as $post)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
            {{-- Post Header --}}
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    {{-- Avatar --}}
                    @if($post->user->pfp)
                        <img src="{{ asset('storage/' . $post->user->pfp) }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    @endif
                    
                    {{-- User Meta --}}
                    <div>
                        <h3 class="font-bold text-slate-900 leading-tight">{{ $post->user->name }}</h3>
                        <span class="text-xs text-slate-500 font-medium">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Options --}}
                <button class="text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
            </div>

            {{-- Post Body --}}
            <div class="mb-5">
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $post->description }}</p>
                
                {{-- Optional: Post Image (if exists) --}}
                @if($post->picture)
                <div class="mt-4 rounded-xl overflow-hidden">
                    <img src="{{ asset('storage/' . $post->picture) }}" class="w-full object-cover">
                </div>
                @endif
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-6 pt-4 border-t border-slate-100">
                <button class="flex items-center gap-2 text-slate-500 hover:text-pink-500 transition group">
                    <div class="w-8 h-8 rounded-full bg-slate-50 group-hover:bg-pink-50 flex items-center justify-center transition-colors">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <span class="text-sm font-medium">Like</span>
                </button>

                <button class="flex items-center gap-2 text-slate-500 hover:text-blue-500 transition group">
                    <div class="w-8 h-8 rounded-full bg-slate-50 group-hover:bg-blue-50 flex items-center justify-center transition-colors">
                        <i class="fa-regular fa-comment"></i>
                    </div>
                    <span class="text-sm font-medium">Comment</span>
                </button>
                
                <button class="flex items-center gap-2 text-slate-500 hover:text-green-500 transition group ml-auto">
                     <i class="fa-solid fa-share nodes"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>

@endsection
