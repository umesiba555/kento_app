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
           <p1>Blog Name</p1>
           <form action="/posts" method="POST"  enctype="multipart/form-data">
               <!--{{ csrf_field() }}-->
               @csrf
               <div class="title">
                   <h2>Title</h2>
                   <input type="text" name="post[title]" placeholder="タイトル"  value="{{ old('post.title') }}"/>
                   <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
               </div>
            
               <div class="body">
                   <h2>Body</h2>
                   <textarea name="post[body]" placeholder="コメント">{{ old('post.body') }}</textarea>
                   <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
               </div>
               <input type="file" name="image">
               <input type="submit" value="投稿"/>
            
            </form>
       
            <div class="back">[<a href="/">戻る</a>]</div>
        @endsection                      
              
    </body>
</html>
