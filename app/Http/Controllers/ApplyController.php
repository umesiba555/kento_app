<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request\Auth;
use App\Post;
use App\Apply;


class ApplyController extends Controller
{
     public function store(Request $request, Post $post)
    {
       \Auth::user()->apply($post->id);
        return back();
    }

    public function destroy(Post $post)
    {
        \Auth::user()->unapply($post->id);
        return back();
    }
    
    public function approve(Post $post, $apply)
    {
        
       //is_approvedをtrueにする
        $post->is_approved=true;
        
       //apply_userにuser_idを入れる
        
        $post->apply_user=$apply;
        $post->save();
        return back();
        
        
    }
    
    public function unapprove(Post $post, $apply){
        $post->is_approved=false;
        $post->apply_user=$apply;
        $post->save();
        return back();
    }
}
