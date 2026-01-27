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
    <div class="bg-white rounded-[32px] p-10 shadow-sm min-h-[500px] flex items-center justify-center text-slate-400">
        Feed content goes here...
    </div>

@endsection
