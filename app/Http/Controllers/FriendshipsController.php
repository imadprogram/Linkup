<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendshipsController extends Controller
{
    public function addFriend($receiverId) {
        $user = auth()->user();

        
        $check1 = \App\Models\Friendship::where('sender_id', $user->id)
                                        ->where('receiver_id', $receiverId)
                                        ->exists();

        
        $check2 = \App\Models\Friendship::where('sender_id', $receiverId)
                                        ->where('receiver_id', $user->id)
                                        ->exists();

        if ($check1 || $check2) {
            return back()->with('error', 'Request already exists or you are already friends.');
        }


        \App\Models\Friendship::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Friend request sent!');
    }

    public function showRequests(){
        $requests = auth()->user()->receivedFriendRequests()->where('status' , 'pending')->with('sender')->get();

        return view('friends', ['requests' => $requests]);
    }
}
