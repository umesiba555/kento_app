<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\comment;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatePost;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleNotification;
use Illuminate\Support\Facades\DB;
use App\Tag;


class PostController extends Controller
{
  public function postmail(Request $request){
    dd($request);
  }
  
  
    public function index(Post $post)
    {
    // $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
     $posts = $post->orderBy('id', 'DESC')->get();
     //dd($posts[0]);
    
      //return view('index')->with(['posts' => $posts->all()]);
      return view('index', ['posts'=> $posts]);
    }
    
    public function show(Post $post)
    {
         $Auth_user = $post;
         $select_tags = $post->tags()->get();
         $post_id = $post->id;
         $apply_user_id=$post->apply_user;
         $post = $post->apply_users()->find($apply_user_id);
         //dd($apply_user_id);
         //$post_tags = $post->tags()->get();
         //dd($post_tags);
      return view('show')->with(['post' => $post, 'Auth_user' => $Auth_user, 'post_id' => $post_id, 'select_tags'=>$select_tags]);
    }
    
    public function create(Post $post, Request $request, Tag $tag)
    {
      $posts = $post->all();
      //dd(Auth::user());
      // $apply_user = $posts[0]->apply_user;
      $all_tags = $tag->all();
      $genres = $all_tags->where('genre')->all();
      $colors = $all_tags->where('color')->all();
      $categories = $all_tags->where('category')->all();
      $patterns = $all_tags->where('pattern')->all();
      return view('create', ['genres' => $genres, 'colors' => $colors, 'categories' => $categories, 'patterns' => $patterns]);
    }
    
    public function store(Post $post, PostRequest $request)
    {
      //dd($request);
      $input = $request['post'];
    
      $post->user_id=$request->user()->id;
      //$post->fill($input);
      $post->title=$input['title'];
      
      $post->body=$input['body'];
      
      if (isset($input['apply_user'])) {
      $post->apply_user = $input['apply_user'];
      }
      
      
      
      $image = $request->file('image');
      // バケットの`myprefix`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
      // アップロードした画像のフルパスを取得
      $post->image_path = Storage::disk('s3')->url($path);
      
      
     $post->save();
      
      
      $tags_id = [];
     //dd($request->pattern);
      if($request->genre){
         array_push($tags_id, $request->genre);
      }
      
      if($request->category){
          array_push($tags_id, $request->category);
      }
      
      if($request->color){
          array_push($tags_id, $request->color);
      }
      
      if($request->pattern){
         array_push($tags_id, $request->pattern);
      }
     //dd($tags_id);
     
      $tags = [];
      foreach($tags_id as $key => $tag_id){
       // dd($tag_id);
           $tag_id = intval($tag_id);//int化
           $post_id = new Post;
           $post_id = Post::latest()->first()->id;
           $new_post = Post::find($post_id);
           $new_post->tags()->attach($tag_id);
            //$tag_id = intval($tag_id);
      }
      
      $post = new Post;
      $new_post_id = Post::latest()->first()->id;
      $new_post_id = Post::find($new_post_id);
      $new_post = $new_post_id->tags()->get();
      //dd($new_post);
       
        // $post_id =Post::latest()->first()->id;
        // $new_post = Post::find($post_id);
        
        // $new_post->tags()->attach($tags_id);
        $sentPostId = new Post;
        $sentPostId = Post::latest()->first()->id;
    // dd($sentNumber);
    
      return redirect('/posts/'. $sentPostId)->with('new_post',$new_post);
      
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
