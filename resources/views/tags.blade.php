<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
       

        <title>blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">


    </head>
    <body>
        @extends('layouts.app')
        @section('content')
        
        <div class="head_titile">
             <h1>Tag Post-List</h1>
        </div>
        
        <form action="{{url('post/tags/{keyword}')}}" method="GET">
            <label for="">タグで検索</label>
            <input type="text"  name="keyword" value="{{$keyword}}">
            <input type="submit" value="検索"  class="btn-primary">
        </form>
      
        
        @foreach($tag_posts as $tag_post)
         <div class= 'posts'>
            <div class = 'post1'>
                       <h2><a href="/posts/{{ $tag_post->id }}">{{ $tag_post->title }}</a></h2>
                       <p1>投稿者:{{ $tag_post->user->name }}</p1>
                       
                       <p2>衣装の説明:{{ $tag_post->body }}</p2>
                      
            </div> 
              @if ($tag_post->image_path)
                     <img src="{{ $tag_post->image_path }}">
                 @endif
        </div>         
                 
                

        @endforeach
        
         <div class = 'back'>[<a href='/'>戻る</a>]</div
        
        @endsection
    </body>
</html>

