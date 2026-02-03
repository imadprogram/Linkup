@extends('layouts.app')

@section('content')
    {{-- Post Card (The post being commented on) --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 mb-6">
        {{-- Post Header --}}
        <div class="flex items-center gap-3 mb-4">
            @if($post->user->pfp)
                <img src="{{ asset('storage/' . $post->user->pfp) }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full object-cover">
            @else
                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                    <i class="fa-solid fa-user"></i>
                </div>
            @endif
            <div>
                <h3 class="font-bold text-slate-900 leading-tight">{{ $post->user->name }}</h3>
                <span class="text-xs text-slate-500 font-medium">{{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>

        {{-- Post Content --}}
        <p class="text-slate-700 leading-relaxed mb-4">{{ $post->description }}</p>

        {{-- Post Stats --}}
        <div class="flex items-center gap-4 text-sm text-slate-500 border-t border-slate-100 pt-4">
            <span><i class="fa-solid fa-heart text-pink-500"></i> {{ $post->likes->count() }} likes</span>
            <span><i class="fa-solid fa-comment text-blue-500"></i> {{ $comments->count() }} comments</span>
        </div>
    </div>

    {{-- Comments Section --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Section Header --}}
        <div class="p-5 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-regular fa-comments text-blue-500"></i> Comments
            </h2>
        </div>

        {{-- Comment Input --}}
        <div class="p-5 bg-slate-50 border-b border-slate-100">
            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex items-start gap-3">
                @csrf
                @if(auth()->user()->pfp)
                    <img src="{{ asset('storage/' . auth()->user()->pfp) }}" alt="" class="w-10 h-10 rounded-full object-cover flex-shrink-0">
                @else
                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 flex-shrink-0">
                        <i class="fa-solid fa-user"></i>
                    </div>
                @endif
                <div class="flex-1">
                    <textarea 
                        name="comment" 
                        rows="2" 
                        class="w-full bg-white rounded-xl p-3 border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 text-slate-700 placeholder-slate-400 resize-none transition-all text-sm"
                        placeholder="Write a comment..."></textarea>
                    <div class="flex justify-end mt-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-all shadow-sm hover:shadow-md">
                            Post Comment
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Comments List --}}
        <div class="divide-y divide-slate-100">
            @forelse($comments as $comment)
                <div class="p-5 hover:bg-slate-50 transition-colors">
                    <div class="flex gap-3">
                        @if($comment->user->pfp)
                            <img src="{{ asset('storage/' . $comment->user->pfp) }}" alt="" class="w-9 h-9 rounded-full object-cover flex-shrink-0">
                        @else
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-slate-800 text-sm">{{ $comment->user->name }}</span>
                                <span class="text-xs text-slate-400">• {{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fa-regular fa-comments text-3xl text-slate-300"></i>
                    </div>
                    <p class="text-slate-400 text-sm">No comments yet. Be the first to share your thoughts!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
