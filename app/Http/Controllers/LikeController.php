<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    //
    public function like($id){
        
        $liked = Like::where('post_id' , $id)->where('user_id' , auth()->id())->first();

        if($liked){
            $liked->delete();
            return back();
        }else{
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $id
            ]);
        }
        return back();
    }
}
