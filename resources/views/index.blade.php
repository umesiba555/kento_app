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
          <h1>Blog Name</h1>
          <p class='create'>[<a href='/posts/create'>投稿</a>]</p>
       
      
          <div class = 'posts'>
              @foreach ($posts as $post)
           
                 <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
   　　                @csrf
   　　             　 @method('DELETE')
   　　             　 <button type="submit">削除 </button> 
　　   　        </form>
           
           
                 <div class = 'post1'>
                       <h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                       <p>{{ $post->user->name }}</p>
                       <p>{{ $post->body }}</p>
                      
               
               
                 </div> 
                 
                 //画像
                 @if ($post->image_path)
                     <img src="{{ $post->image_path }}">
                 @endif
                 
              @endforeach
           
        @endsection   
       </div> 
          
             
    </body>
</html>
