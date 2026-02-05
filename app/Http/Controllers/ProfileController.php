<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;
use App\Models\Friendship;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('pfp')){
            $path = $request->file('pfp')->store('profile-picture' , 'public');
            $request->user()->pfp = $path;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $users = User::where('username' , 'ILIKE' , "%{$query}%")->get();

        return view('search_results' , ['users' => $users]);
    }

    public function showProfile($username){
        $user = User::where('username' , $username)->first();
        $posts = Post::where('user_id', $user->id)->get();

        $check1 = Friendship::where('sender_id', $user->id)
            ->where('receiver_id', auth()->id())
            ->first();

        $check2 = Friendship::where('sender_id', auth()->id())
            ->where('receiver_id', $user->id)
            ->first();

        $friendship = $check1 ? $check1 : $check2;

        return view('profile', compact('user', 'posts', 'friendship'));
    }

    public function liveSearch(Request $request){
        $query = $request->input('q');

        $users = User::where('username' , 'ILIKE' , "%{$query}%")
        ->orWhere('name' , 'ILIKE' , "%{$query}%")
        ->limit(5)
        ->get();

        return response()->json($users);
    }
}

