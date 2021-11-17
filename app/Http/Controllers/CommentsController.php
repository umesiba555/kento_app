<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;

class CommentsController extends Controller
{
    
    public function store(CommentRequest $request, Post $post)
    {
        dd($request);
        $savedata = [
            'post_id' => $request['post_id'],
            'name' => $request['name'],
            'body' => $request['comment'],
        ];
       
        $comment = new Comment;
        $comment->fill($savedata)->save();
        
        $sentPostId = new Post;
        $sentPostId = Post::latest()->first()->id;
 
        return redirect('/posts/' . $sentPostId);
    }
    
    
    // public function store(Request $request, $postId) {
    //   $this->savedate($request, [
    //     'body' => 'required'
    //   ]);

    //   $comment = new Comment(['body' => $request->body]);
    //   $post = Post::findOrFail($postId);
    //   $post->comments()->save($comment);

    //   return redirect()
    //          ->action('PostsController@show', $post->id);
    // }
}
