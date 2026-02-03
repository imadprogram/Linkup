@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mt-6">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-400">
                <i class="fa-solid fa-pen-to-square text-xl"></i>
            </div>
            <div>
                <h2 class="font-bold text-lg text-slate-800">Edit Post</h2>
                <p class="text-sm text-slate-500">Update your thoughts</p>
            </div>
        </div>

        <form action="{{ route('updatePost', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <textarea 
                    name="description" 
                    rows="4" 
                    class="w-full bg-slate-50 rounded-xl p-4 border-none focus:ring-2 focus:ring-blue-500/20 text-slate-700 placeholder-slate-400 resize-none transition-all"
                    placeholder="What's on your mind?">{{ $post->description }}</textarea>
            </div>

            <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                <div class="flex gap-2">
                    {{-- Decorative buttons --}}
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-xl transition-all shadow-md hover:shadow-lg transform active:scale-95">
                    Update Post
                </button>
            </div>
        </form>
    </div>
@endsection