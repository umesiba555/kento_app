<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\Auth;
use Illuminate\Http\Request;
use App\Post;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
       \Auth::user()->like($post->id);
        return back();
    }

    public function destroy(Post $post)
    {
        \Auth::user()->unlike($post->id);
        return back();
    }
}
