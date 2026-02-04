@extends('layouts.app')

@section('content')
    {{-- Profile Header Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        {{-- Cover Photo --}}
        <div class="h-32 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
        
        {{-- Profile Info --}}
        <div class="px-6 pb-6">
            {{-- Avatar --}}
            <div class="-mt-12 mb-4">
                @if($user->pfp)
                    <img src="{{ asset('storage/' . $user->pfp) }}" alt="{{ $user->name }}" 
                        class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                @else
                    <div class="w-24 h-24 rounded-full bg-slate-200 border-4 border-white shadow-lg flex items-center justify-center">
                        <i class="fa-solid fa-user text-3xl text-slate-400"></i>
                    </div>
                @endif
            </div>

            {{-- User Details --}}
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">{{ $user->name }}</h1>
                    <p class="text-slate-500">{{ '@' . $user->username }}</p>
                    
                    {{-- Stats --}}
                    <div class="flex gap-6 mt-4 text-sm">
                        <div>
                            <span class="font-bold text-slate-900">{{ $posts->count() }}</span>
                            <span class="text-slate-500">Posts</span>
                        </div>
                        <div>
                            <span class="font-bold text-slate-900">{{ $user->sentFriendRequests()->where('status', 'accepted')->count() + $user->receivedFriendRequests()->where('status', 'accepted')->count() }}</span>
                            <span class="text-slate-500">Friends</span>
                        </div>
                    </div>
                </div>

                {{-- Action Button --}}
                @if(auth()->id() !== $user->id)
                    @if($friendship && $friendship->status == 'accepted')
                        {{-- Already Friends - Show Unfriend --}}
                        <form action="{{ route('friend.handle', $user->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="reject">
                            <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 font-semibold py-2 px-6 rounded-xl transition-all">
                                <i class="fa-solid fa-user-minus mr-2"></i> Unfriend
                            </button>
                        </form>
                    @elseif($friendship && $friendship->status == 'pending' && $friendship->sender_id == auth()->id())
                        {{-- I sent the request - Show Request Sent --}}
                        <button disabled class="bg-slate-100 text-slate-500 font-semibold py-2 px-6 rounded-xl cursor-not-allowed">
                            <i class="fa-solid fa-clock mr-2"></i> Request Sent
                        </button>
                    @elseif($friendship && $friendship->status == 'pending' && $friendship->receiver_id == auth()->id())
                        {{-- They sent request - Show Accept --}}
                        <form action="{{ route('friend.handle', $user->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="accept">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-xl transition-all shadow-sm hover:shadow-md">
                                <i class="fa-solid fa-check mr-2"></i> Accept Request
                            </button>
                        </form>
                    @else
                        {{-- No relationship - Show Add Friend --}}
                        <form action="{{ route('friend.add', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-xl transition-all shadow-sm hover:shadow-md">
                                <i class="fa-solid fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('profile.edit') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-2 px-6 rounded-xl transition-all">
                        <i class="fa-solid fa-pen mr-2"></i> Edit Profile
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Posts Section --}}
    <div class="mb-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-newspaper text-blue-500"></i> Posts
        </h2>
    </div>

    {{-- Posts List --}}
    <div class="flex flex-col gap-5">
        @forelse($posts as $post)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
            {{-- Post Header --}}
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    @if($user->pfp)
                        <img src="{{ asset('storage/' . $user->pfp) }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    @endif
                    <div>
                        <h3 class="font-bold text-slate-900 leading-tight">{{ $user->name }}</h3>
                        <span class="text-xs text-slate-500 font-medium">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            {{-- Post Body --}}
            <div class="mb-5">
                <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $post->description }}</p>
                
                @if($post->picture)
                <div class="mt-4 rounded-xl overflow-hidden">
                    <img src="{{ asset('storage/' . $post->picture) }}" class="w-full object-cover">
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
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-10 text-center">
            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-newspaper text-3xl text-slate-300"></i>
            </div>
            <p class="text-slate-400">No posts yet.</p>
        </div>
        @endforelse
    </div>
@endsection
