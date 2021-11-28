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
    //   return view('index')->with(['posts' => $posts->all()]);
      return view('index', ['posts'=> $posts]);
    }
    
    public function tags(Request $request)
    {
         $keyword = $request->input("keyword");
         $query = Post::query();
         $tag_posts = [];
         
         function tag_genre($keyword){
               $tag_posts = Post::whereHas('tags', function ($query) use ($keyword) {
               $query->where('genre', 'LIKE', "%{$keyword}%");
            })->get();
            
            return $tag_posts;
            //array_push($tag_posts, $tag_post);
            //$tag_posts = $tag_post;
         }
         function tag_color($keyword){
               $tag_post = Post::whereHas('tags', function ($query) use ($keyword) {
               $query->where('color', 'LIKE', "%{$keyword}%");
            })->get();
            return $tag_posts;
         }
         function tag_pattern($keyword){
             $tag_post=[];
               $tag_post = Post::whereHas('tags', function ($query) use ($keyword) {
               $query->where('pattern', 'LIKE', "%{$keyword}%");
            })->get();
            return $tag_posts;
         }
         function tag_category($keyword){
               $tag_post = Post::whereHas('tags', function ($query) use ($keyword) {
               $query->where('category', 'LIKE', "%{$keyword}%");
            })->get();
            return $tag_posts;
         }
         
         switch($keyword){
             case 'break': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'rock': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'house': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'pop': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'wacck': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'jazz': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'krump': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'new hip': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'middle hip': 
            $tag_posts = tag_genre($keyword);
             break;
              case 'style hip': 
            $tag_posts = tag_genre($keyword);
             break;
             case '白系':
            $tag_posts = tag_color($keyword);
              break;
              case '黒系': 
            $tag_posts = tag_color($keyword);
             break;
              case '青系': 
            $tag_posts = tag_color($keyword);
             break;
              case '緑系': 
            $tag_posts = tag_color($keyword);
             break;
              case '赤系': 
            $tag_posts = tag_color($keyword);
             break;
              case '黄色系': 
            $tag_posts = tag_color($keyword);
             break;
              case 'トップス': 
            $tag_posts = tag_category($keyword);
             break;
              case 'ジャケット/アウター': 
            $tag_posts = tag_category($keyword);
             break;
              case 'パンツ': 
            $tag_posts = tag_category($keyword);
             break;
              case 'スカート': 
            $tag_posts = tag_category($keyword);
             break;
              case 'ワンピース/ドレス': 
            $tag_posts = tag_category($keyword);
             break;
              case 'シューズ': 
            $tag_posts = tag_category($keyword);
             break;
              case 'アクセサリー': 
            $tag_posts = tag_category($keyword);
             break;
              case 'ヘアアクセサリー': 
            $tag_posts = tag_category($keyword);
             break;
              case 'レグウェア': 
            $tag_posts = tag_category($keyword);
             break;
              case '帽子': 
            $tag_posts = tag_category($keyword);
             break;
              case 'チェック': 
            $tag_posts = tag_pattern($keyword);
             break;
              case '和柄': 
            $tag_posts = tag_pattern($keyword);
             break;
              case 'ボーダー': 
            $tag_posts = tag_pattern($keyword);
             break;
              case 'ストライプ': 
            $tag_posts = tag_pattern($keyword);
             break;
              case 'ゼブラ': 
            $tag_posts = tag_pattern($keyword);
             break;
              case '迷彩': 
            $tag_posts = tag_pattern($keyword);
             break;
              case '無地': 
            $tag_posts = tag_pattern($keyword);
             break;
         }
         
        return view('tags', ['tag_posts'=>$tag_posts, 'keyword'=>$keyword]);
    }
    
    public function show(Post $post)
    {
         $Auth_user = $post;
         $select_tags = $post->tags()->get();
         $post_id = $post->id;
         $apply_user_id=$post->apply_user;
         $post = $post->apply_users()->find($apply_user_id);
         //$post_tags = $post->tags()->get();
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
