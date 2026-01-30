@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-7">
        @foreach ($users as $user)
            <div class="w-full bg-slate-300 rounded-xl shadow-sm px-7 py-4 flex justify-between font-bold">
                <div class="flex gap-4">
                    <div class="avatar">
                        <div class="ring-primary ring-offset-base-100 w-14 rounded-full ring-2 ring-offset-2">
                            <img
                                src="{{ $user->pfp ? asset('storage/' . $user->pfp) : 'https://i.pravatar.cc/150?img=1' }}" />
                        </div>
                    </div>

                    <div>
                        <h1>{{ $user->name }}</h1>
                        <span class="font-semibold text-sm text-gray-700"> {{ $user->username }}</span>
                    </div>
                </div>
                <form action="{{ route('friend.add', $user->id) }}" method="POST">
                    @csrf
                    @if (auth()->id() != $user->id)
                        <button type="submit" class="px-4 py-2 rounded-xl hover:bg-black hover:text-white transition-colors"><i
                        class="fa-solid fa-user-plus"></i> Add Friend</button>
                    @endif
                </form>
            </div>
        @endforeach
    </div>
@endsection
