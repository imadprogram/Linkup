<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendshipsController extends Controller
{
    public function addFriend($receiverId)
    {
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

    public function index()
    {
        // 1.Requests
        $requests = auth()->user()->receivedFriendRequests()->where('status', 'pending')->with('sender')->get();

        // 2.Friends
        $friends = \App\Models\Friendship::where('status' , 'accepted')
        ->where(function($q){
            $q->where('sender_id' , auth()->id())->orWhere('receiver_id' , auth()->id());
        })
        ->with(['sender', 'receiver'])
        ->get();

        return view('friends', compact('requests', 'friends'));
    }

    public function handleFriendRequest(Request $request, $senderId)
    {

        $action = $request->input('action');

        $friendship = \App\Models\Friendship::where('sender_id', $senderId)
            ->where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if ($action == 'accept') {
        }

        if ($friendship) {
            if ($action == 'accept') {
                $friendship->update(['status' => 'accepted']);
                return back()->with('success', 'Friend request accepted!');

            } elseif ($action == 'reject') {
                $friendship->update(['status' => 'rejected']);
                return back()->with('success', 'Friend request rejected!');
            }
        }

        return back()->with('failed', 'Request not found');
    }


}
