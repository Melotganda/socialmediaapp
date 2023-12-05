<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function updatedComment(Comment $comment, Request $request){
        if(auth()->user()->id !== $comment['user_id']){
            return back();
        }

        $incomingField = $request->validate([
            'body' => 'required'
        ]);

        $incomingField['body'] =strip_tags($incomingField['body']); 

        $comment->update($incomingField);
        return view('postcomments', ['post' => $comment->post]);
    }
    public function showEditscreen(Comment $comment){
        if(auth()->user()->id !== $comment['user_id']){
            return back();
        }
        return view('edit-comment', ['comment' => $comment]);
    }

    public function showComments(Comment $comment, Post $post){

        return view('postcomments', ['post' => $post]);
    }
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);

        auth()->user()->comments()->create([
            'post_id' => $post->id,
            'body' => $request->input('body'),
        ]);

        return back();
    }

    public function destroy(Comment $comment){

            if(auth()->user()->id === $comment['user_id']){
                $comment->delete();
            }
            return back();

    }
}