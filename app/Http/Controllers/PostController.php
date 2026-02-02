<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function store(Request $request){
        $description = $request->input('description');

        auth()->user()->posts()->create([
            'description' => $description
        ]);
        
        return back()->with('success' , 'Post has created');
    }

    public function getPosts(){
        $userId = auth()->id();

        $friends1 = \App\Models\Friendship::where('sender_id', $userId)
                    ->where('status', 'accepted')
                    ->pluck('receiver_id')
                    ->toArray();

        $friends2 = \App\Models\Friendship::where('receiver_id', $userId)
                    ->where('status', 'accepted')
                    ->pluck('sender_id')
                    ->toArray();

        // merge them + add my id (so i can see my own posts)
        $allowedUserIds = array_merge($friends1, $friends2, [$userId]);

        $posts = Post::whereIn('user_id', $allowedUserIds)
                 ->latest()
                 ->get();

        return view('feed' , ['posts' => $posts]);
    }
}
