<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Int $postId){
        $post = Post::find($postId);
        // dd($post);
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
                
        }
        return redirect('/');
    }

    public function updatedPost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] =strip_tags($incomingFields['title']);
        $incomingFields['body'] =strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');

    }
    public function showEditscreen(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }
    public function createPost(Request $request){
    $incomingFields = $request->validate([
    'title' => 'required',
    'body' => 'required'
]);

    $incomingFields['title'] =strip_tags($incomingFields['title']);
    $incomingFields['body'] =strip_tags($incomingFields['body']);
    $incomingFields['user_id'] =auth()->user()->id;
    Post::create($incomingFields);

    return redirect('/');
    }

}
