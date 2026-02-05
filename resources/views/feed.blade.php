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
                        <a href="{{ route('profile' , $post->user->username) }}">
                            <img src="{{ asset('storage/' . $post->user->pfp) }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full object-cover">
                        </a>
                    @else
                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    @endif
                    
                    {{-- User Meta --}}
                    <div class="flex flex-col">
                        <a href="{{ route('profile' , $post->user->username) }}" class="font-bold text-slate-900 leading-tight">{{ $post->user->name }}</a>
                        <span class="text-xs text-slate-500 font-medium">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Options Dropdown (Only for Author) --}}
                @if(auth()->id() === $post->user_id)
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="text-slate-400 hover:text-slate-600 transition p-2">
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-lg bg-white rounded-box w-40 border border-slate-100">
                        <li>
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-slate-600 hover:text-blue-600 hover:bg-blue-50">
                                <i class="fa-regular fa-pen-to-square"></i> Edit
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('destroy', $post->id) }}" method="POST" class="p-0">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:bg-red-50 w-full text-left flex gap-2 items-center px-4 py-2">
                                    <i class="fa-regular fa-trash-can"></i> Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endif
            </div>

            {{-- Post Body --}}
            <div class="mb-5">
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $post->description }}</p>
                
                {{-- Post Images --}}
                @if($post->images->count() > 0)
                <div class="mt-4 grid gap-2 {{ $post->images->count() > 1 ? 'grid-cols-2' : 'grid-cols-1' }}">
                    @foreach($post->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" class="w-full h-64 object-cover rounded-xl">
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-6 pt-4 border-t border-slate-100">
                <form action="{{ route('like.post', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="flex items-center gap-2 text-slate-500 hover:text-pink-500 transition group">
                        <div class="w-8 h-8 rounded-full bg-slate-50 group-hover:bg-pink-50 flex items-center justify-center transition-colors">
                            @if($post->likes->where('user_id', auth()->id())->count() > 0)
                                <i class="fa-solid fa-heart text-pink-500"></i>
                            @else
                                <i class="fa-regular fa-heart"></i>
                            @endif
                        </div>
                        <span class="text-sm font-medium">{{ $post->likes->count() }}</span>
                    </button>
                </form>

                
                <a href="{{ route('comments.show', $post->id) }}" class="flex items-center gap-2 text-slate-500 hover:text-blue-500 transition group">
                    <div class="w-8 h-8 rounded-full bg-slate-50 group-hover:bg-blue-50 flex items-center justify-center transition-colors">
                        <i class="fa-regular fa-comment"></i>
                    </div>
                    <span class="text-sm font-medium">Comment</span>
                </a>
                
                <button class="flex items-center gap-2 text-slate-500 hover:text-green-500 transition group ml-auto">
                     <i class="fa-solid fa-share nodes"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>

@endsection
