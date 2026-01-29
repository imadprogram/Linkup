@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-7">
        @foreach ($users as $user)
            <div class="w-full bg-slate-300 rounded-xl shadow-sm px-7 py-4 flex gap-4 font-bold">
                <div class="avatar">
                    <div class="ring-primary ring-offset-base-100 w-14 rounded-full ring-2 ring-offset-2">
                        <img src="{{ $user->pfp ? asset('storage/' . $user->pfp) : 'https://i.pravatar.cc/150?img=1' }}" />
                    </div>
                </div>

                <div>
                    <h1>{{ $user->name }}</h1>
                    <span class="font-semibold text-sm text-gray-700"> {{ $user->email }}</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
