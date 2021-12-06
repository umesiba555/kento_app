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
        
            <div class="head_title">
             <h1>Edit Post</h1>
          </div>  
      
      
           <div class="content">
               <form action="/posts/{{ $post->id }}" method="POST">
                    @csrf
                    @method('PUT')
            
                   <div class='content__title'>
                       <h2>タイトル</h2>
                       <input type='text' name='post[title]' value="{{ $post->title }}">
                   </div>
            
                   <div class='content__body'>
                       <h2>本文</h2>
                       <input type='text' name='post[body]' value="{{ $post->body }}">
                   </div>
                   
                   //改善案（tagも編集できるようにする）
            
                   <input type="submit" value="保存">
               
                   
               </form>
              
               
        
           
               <div class="back">[<a href="/posts/{{ $post->id }}">戻る</a>]</div>
        
               
           </div>
       
           
        
           
        
       @endsection 
    
    </body>
</html>
