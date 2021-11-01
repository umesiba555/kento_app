<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\comment;
use Storage;

class PostController extends Controller
{
    public function index(Post $post)
    {
      return view('index')->with(['posts' => $post->getPaginate()]);
    }
    
    public function show(Post $post)
    {
      $Auth_user = $post;
      $user_id=$post->apply_user;
     $post = $post->apply_users()->find($user_id);
     return view('show')->with(['post' => $post, 'Auth_user' => $Auth_user]);
    }
    
    public function create(Request $request)
    {
      return view('create');
      
    }
    
    public function store(Post $post, PostRequest $request)
    {
      $input = $request['post'];
      $post->user_id=$request->user()->id;
      $post->fill($input);
      
      $image = $request->file('image');
      // バケットの`myprefix`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
      // アップロードした画像のフルパスを取得
      $post->image_path = Storage::disk('s3')->url($path);

      $post->save();
      
      return redirect('/posts/' . $post->id);
      
      
    }
    
    public function edit(Post $post)
    {
      return view('edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
      $input_post = $request['post'];
      $post->fill($input_post)->save();
      return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
      $post->delete();
      return redirect('/');
    }
    
    
    
    
    
}
