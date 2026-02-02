<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
