@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Friends & Requests</h1>
            <p class="text-slate-500">Manage your connections</p>
        </div>

        {{-- SECTION: Friend Requests --}}
        <div class="mb-10">
            <h2 class="text-lg font-bold text-slate-700 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user-clock text-blue-500"></i> Friend Requests <span
                    class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">2</span>
            </h2>

            <div class="grid gap-4">
                @foreach ($requests as $person)
                    <div class="bg-white p-4 rounded-2xl shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <img src="{{ $person->sender->pfp ? asset('storage/' . $person->sender->pfp) : 'https://i.pravatar.cc/150?img=33' }}"
                                alt="" class="w-12 h-12 rounded-full object-cover ring-2 ring-blue-100">
                            <div>
                                <h3 class="font-bold text-slate-800">{{ $person->sender->name }}</h3>
                                <p class="text-xs text-slate-400">Sent 2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <form action="{{ route('friend.handle', $person->sender->id) }}" method="POST">
                                @csrf
                                <button type="submit" name="action" value="accept"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition">Accept</button>
                                <button type="submit" name="action" value="reject"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-xl text-sm font-bold transition">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- SECTION: My Friends (Placeholder) --}}
        <div>
            <h2 class="text-lg font-bold text-slate-700 mb-4">My Friends</h2>
            <div class="bg-slate-100 rounded-xl p-8 text-center text-slate-400">
                @foreach ($friends as $friendship)
                    @php
                        $friendUser = $friendship->sender_id == auth()->id() ? $friendship->receiver : $friendship->sender;
                    @endphp
                    <div class="bg-white p-4 rounded-2xl shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <img src="{{ $friendUser->pfp ? asset('storage/' . $friendUser->pfp) : 'https://i.pravatar.cc/150?img=33' }}"
                                alt="" class="w-12 h-12 rounded-full object-cover ring-2 ring-blue-100">
                            <div>
                                <h3 class="font-bold text-slate-800">{{ $friendUser->name }}</h3>
                                <p class="text-xs text-slate-400">Friend</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <form action="{{ route('friend.handle', $friendship->id) }}" method="POST">
                                @csrf
                                <button type="submit" name="action" value="reject"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-xl text-sm font-bold transition">Unfriend</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                You have no friends yet. Go search for people!
            </div>
        </div>

    </div>
@endsection
