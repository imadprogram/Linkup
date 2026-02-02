@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mt-6">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center text-slate-400">
                <i class="fa-solid fa-user text-xl"></i>
            </div>
            <div>
                <h2 class="font-bold text-lg text-slate-800">Create Post</h2>
                <p class="text-sm text-slate-500">Share your thoughts with friends</p>
            </div>
        </div>

        <form action="{{ route('post') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <textarea 
                    name="description" 
                    rows="4" 
                    class="w-full bg-slate-50 rounded-xl p-4 border-none focus:ring-2 focus:ring-blue-500/20 text-slate-700 placeholder-slate-400 resize-none transition-all"
                    placeholder="What's on your mind, Emad?"></textarea>
            </div>

            <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                <div class="flex gap-2">
                    <button type="button" class="p-2 rounded-full text-slate-400 hover:bg-slate-50 hover:text-green-500 transition-colors cursor-pointer" title="Add Image">
                        <i class="fa-regular fa-image text-xl"></i>
                    </button>
                    <button type="button" class="p-2 rounded-full text-slate-400 hover:bg-slate-50 hover:text-blue-500 transition-colors cursor-pointer" title="Tag Friend">
                        <i class="fa-solid fa-user-tag text-xl"></i>
                    </button>
                    <button type="button" class="p-2 rounded-full text-slate-400 hover:bg-slate-50 hover:text-yellow-500 transition-colors cursor-pointer" title="Feeling/Activity">
                        <i class="fa-regular fa-face-smile text-xl"></i>
                    </button>
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-xl transition-all shadow-md hover:shadow-lg transform active:scale-95">
                    Post
                </button>
            </div>
        </form>
    </div>
@endsection