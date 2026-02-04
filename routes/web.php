<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendshipsController;
use App\Models\Post;

Route::get('/', function () {
    return view('landing');
});

Route::get('/home', [App\Http\Controllers\PostController::class , 'getPosts'])->name('home');

Route::get('/search' , [App\Http\Controllers\ProfileController::class , 'search'])->name('search');

Route::get('/friends' , [App\Http\Controllers\FriendshipsController::class , 'index'])->name('friends');

Route::post('/handle-friend/{id}', [App\Http\Controllers\FriendshipsController::class , 'handleFriendRequest'])->name('friend.handle');

Route::get('/new-post' , function(){
    return view('newPost');
})->name('new.post');

Route::post('/new-post' , [App\Http\Controllers\PostController::class , 'store'])->name('post');

Route::put('/posts/{id}' , [App\Http\Controllers\PostController::class , 'update'])->name('updatePost');

Route::get('/posts/{id}/edit', function ($id) {
    $post = Post::findOrFail($id);

    if (auth()->id() !== $post->user_id) {
       return redirect()->route('home')->with('error', 'Unauthorized');
    }

    return view('editPost', ['post' => $post]);
})->name('posts.edit');

Route::delete('/postDelete/{id}' , [App\Http\Controllers\PostController::class , 'destroy'])->name('destroy');

Route::put('/likePost/{id}' , [App\Http\Controllers\LikeController::class , 'like'])->name('like.post');

Route::get('/posts/{id}/comments' , [App\Http\Controllers\CommentController::class , 'show'])->name('comments.show');

Route::post('/posts/{id}/comments' , [App\Http\Controllers\CommentController::class , 'comment'])->name('comments.store');

Route::get('/profile/{username}' , [App\Http\Controllers\ProfileController::class , 'showProfile'])->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/add-friend/{id}', [FriendshipsController::class, 'addFriend'])->name('friend.add');
});

require __DIR__.'/auth.php';
