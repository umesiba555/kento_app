<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
       

        <title>blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
      　<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

      
    </head>
    <body>
     
        @extends('layouts.app')
        @section('content')
       
          <div class="head_title">
             <h1>Create Post</h1>
          </div>  
          
           <div class="create_post">
               <form action="/posts" method="POST"  enctype="multipart/form-data">
                   <!--{{ csrf_field() }}-->
                   @csrf
                    <div class="title_body">
                       <h2>Title</h2>
                       <input type="text" name="post[title]" placeholder="タイトル"  value="{{ old('post.title') }}"/>
                       <p1 class="title__error" style="color:red">{{ $errors->first('post.title') }}</p1>
                   
                       <h2>Body</h2>
                       <textarea name="post[body]" placeholder="コメント">{{ old('post.body') }}</textarea>
                       <p2 class="body__error" style="color:red">{{ $errors->first('post.body') }}</p2>
                      
                      @if(isset($apply_user))
                       <input type="hidden" name="post[apply_user]"  value="{{$apply_user}}" />
                      @endif 
                   </div>
                  
                 
                   <div class="btn-group colors">
                       <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        カラー
                       </button>
                  
                  
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           @foreach($colors as $color)
                              <li>
                                  <input value={{ $color->id }} name="color" class="form-check-input" type="radio"  id="flexCheckDefault">
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    {{ $color->color }}
                                  </label>
                              </li>
                          @endforeach
                      </ul>
                   </div>
                   
                  <div class="btn-group genres">
                       <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        ジャンル
                       </button>
                      
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               @foreach($genres as $genre)
                                  <li>
                                      <input value={{ $genre->id }} name="genre" class="form-check-input" type="radio"  id="flexCheckDefault">
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        {{ $genre->genre }}
                                      </label>
                                  </li>
                              @endforeach
                          </ul>
                    </div>
              
                  
                    <div class="btn-group categories">
                       <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        カテゴリー
                       </button>
                      
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               @foreach($categories as $category)
                                  <li>
                                      <input value={{ $category->id }} name="category" class="form-check-input" type="radio"  id="flexCheckDefault">
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        {{ $category->category }}
                                      </label>
                                  </li>
                              @endforeach
                          </ul>
                     </div>

                     <div class="btn-group patterns">
                       <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        デザイン
                       </button>
                      
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               @foreach($patterns as $pattern)
                                  <li>
                                      <input value={{$pattern->id}} name="pattern" class="form-check-input" type="radio"  id="flexCheckDefault">
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        {{ $pattern->pattern }}
                                      </label>
                                  </li>
                              @endforeach
                          </ul>
                    </div>
            
                  
                   <p><input type="file" name="image" /></p>
                   <p><input type="submit" value="投稿"/></p>
                </form>
           </div>
            
            <div class="back">[<a href="/">戻る</a>]</div>
        @endsection                      
              
    </body>
</html>
