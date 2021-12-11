<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
       

        <title>blog</title>
        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        
       
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        
       
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
        
        <div class="head_title">
             <h1>Post List</h1>
        </div>
        
        
         <form action="{{url('/post/tags/{keyword}')}}" method="GET" class="fa fa-search search-form">
            <p><i class="material-icons">search</i></p>

            <input type="search"  name="keyword" value=""　class="search-text">
            <input type="submit" value="検索"  class="btn-primary">
         </form>
          
          <p1 class='create'>[<a href='/posts/create'>+投稿</a>]</p1>
    
          
            @foreach ($posts as $key => $post)
           　<div class = 'posts'>
            <a href="/posts/{{ $post->id }}">
                 <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
   　　                @csrf
   　　             　 @method('DELETE')
   　　            
　　   　        </form>
                     
           
                 <div class = 'post1'>
                     <a href="/posts/{{ $post->id }}">
                       <h2>{{ $post->title }}</a></h2>
                       <p1>投稿者:{{ $post->user->name }}</p1>
                       
                       <p2>衣装の説明:{{ $post->body }}</p2>
                 </div> 
                 
                 
                 @if ($post->image_path)
                     <img src="{{ $post->image_path }}">
                 @endif
            </a>

             </div> 
           @endforeach    
       @endsection      
    </body>
</html>