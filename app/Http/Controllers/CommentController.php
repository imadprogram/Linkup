<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    //
    public function comment(Request $request , $id){
        
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $id,
            'content' => $request->input('comment')
        ]);

        return back()->with('success' , 'comment has published');
    }

    public function show($id){
        $comments = Comment::where('post_id' , $id)->get();

        $post = Post::find($id);

        return view('comment', compact('post' , 'comments'));
    }
}
