@extends('layouts.app')

@section('content')

    @foreach($users as $user)
        <div class="w-full bg-slate-300 rounded-xl shadow-sm px-7 py-4 font-bold">
            {{ $user->name }} <br> {{ $user->email }}
        </div>
    @endforeach

@endsection
