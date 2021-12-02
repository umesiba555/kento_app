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
             <h1>Post List</h1>
        </div>
        
         <form action="{{url('/post/tags/{keyword}')}}" method="GET">
            <label for="">タグで検索</label>
            <input type="text"  name="keyword">
            <input type="submit" value="検索"  class="btn-primary">
         </form>
          
          <h2 class='create'>[<a href='/posts/create'>+投稿</a>]</h2>
    
          
            @foreach ($posts as $key => $post)
           　<div class = 'posts'>
                 <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
   　　                @csrf
   　　             　 @method('DELETE')
   　　            
　　   　        </form>
                     
           
                 <div class = 'post1'>
                       <h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                       <p1>投稿者:{{ $post->user->name }}</p1>
                       
                       <p2>衣装の説明:{{ $post->body }}</p2>
                 </div> 
                 
                 
                 @if ($post->image_path)
                     <img src="{{ $post->image_path }}">
                 @endif

             </div> 
           @endforeach    
       @endsection      
    </body>
</html>

           
