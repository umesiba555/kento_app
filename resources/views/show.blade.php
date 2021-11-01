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
       
      　　<p class="edit">[<a href="/posts/{{ $Auth_user->id }}/edit">編集</a>]</p>
      
      　　　 <form action="/posts/{{ $Auth_user->id }}" id="form_delete" method="post">
          　　　  @csrf
          　　  　@method('delete')
          　　　 <input type="submit" style="display:none">
          　　　 <p class='delete'>[<span onclick="return deletePost(this);">削除</span>]</p>
      　　　 </form>
       
       
       　　　<div class = 'post'>
          　　　 <h2 class = 'titile'>{{ $Auth_user -> title }}</h2>
          　　　 <p class = 'body' >{{ $Auth_user -> body }}</p>
          　　　 <p class = 'updated_at'>{{ $Auth_user -> updated_at }}</p>
          　　
          　　　 @if ($Auth_user->image_path)
                     <img src="{{ $Auth_user->image_path }}">
               @endif
      　　　 </div>
      　　　 
      　　　 /*いいねボタン*/
      　　　 
      　　　 
      　<div>
           @if (Auth::id() != $Auth_user->user->id)

               @if (Auth::user()->is_like($Auth_user->id))
                
                   <form class="mb-4" method="POST" action="{{route('likes.unlike',['post'=> $Auth_user->id])}}">
   　                    @csrf
   　                    @method('DELETE')
   　                    <input name="post_id" type="hidden" value="{{ $Auth_user->id}}" >
   　                    <div class="mt-4">
                          <button type="submit" class="btn btn-primary">いいね！を外す</button>
                        </div>
   　                  
   　             　</form>
   　             　 
   　             　
   　           @else
   　                <form class="mb-4" method="POST" action="{{route('likes.like',['post'=> $Auth_user->id])}}">
   　                    @csrf
   　                    <input name="post_id" type="hidden" value="{{ $Auth_user->id }}" >
   　                    <div class="mt-4">
                            <button type="submit" class="btn btn-primary">いいね！</button>
                        </div>
   　                </form>
   　               
   　                
   　           @endif
           
           @endif
           
           
              <p>{{$Auth_user->like_users->count()}}</p>
         
                  
        </div>  
        
        //申請
        <div>
           @if (Auth::id() != $Auth_user->user->id)
            

               @if (Auth::user()->is_apply($Auth_user->id))
                
                   <form class="mb-4" method="POST" action="{{route('applies.unapply',['post'=> $Auth_user->id])}}">
   　                    @csrf
   　                    @method('DELETE')
   　                    <input name="post_id" type="hidden" value="{{ $Auth_user->id}}" >
   　                    <div class="mt-4">
                          <button type="submit" class="btn btn-primary">「申請中．．．」</button>
                        </div>
   　                  
   　             　</form>
   　             　 
   　             　
   　           
   　               
   　           @else
       　            <form class="mb-4" method="POST" action="{{route('applies.apply',['post'=> $Auth_user->id])}}">
       　                    @csrf
       　                    <input name="post_id" type="hidden" value="{{ $Auth_user->id }}" >
       　                    <div class="mt-4">
                                <button type="submit" class="btn btn-primary">「申請」</button>
                            </div>
   　                </form>
                @endif
           @endif
           
           
           //承認ボタン
           @foreach($Auth_user->apply_users as $apply_user)
             
              
               @if(Auth::id() == $Auth_user->user->id)
              
                   @if (!($Auth_user->is_approved))
                    <p>{{$apply_user->name}}</p>
                    
                       <form class="mb-4" method="POST" action="{{route('apply.approved',['post'=> $Auth_user->id,'apply'=> $apply_user->id])}}">
                          
       　                    @csrf
       　                    <input name="post_id" type="hidden" value="{{ $Auth_user->id}}" >
       　                    
       　                    <div class="mt-4">
                              <button type="submit" class="btn btn-primary">「承認」</button>
                            </div>
       　                  
       　               </form>
       　           @endif
       　      @endif
       　               
     
           @endforeach
           
      @if($Auth_user->is_approved)
                   <p>{{$post->name}}</p>
           　            
           　          <form class="mb-4" method="POST" action="{{route('apply.unapproved',['post'=> $Auth_user->id,'apply'=> $apply_user->id])}}">
                              
           　          @csrf
           　          @method('delete')
           　         <input name="post_id" type="hidden" value="{{ $Auth_user->id}}" >
           　                    
           　          <div class="mt-4">
                        <button type="submit" class="btn btn-primary">「承認」を取り消す</button>
                      </div>
           
            
   　 @endif

           
                
           
            
       　        
         
                  
        </div>   
        
       
 
 
               
          

      　　　 
      　　　 <p>【コメント一覧】</p>
      　　　@foreach($Auth_user->comments as $comment) 
      　　  　 <p>{{$comment->name }}</p>
      　　     <p>{{$comment->body }}</p>
          @endforeach
      　　　 
   　　　　　　　　　　　　　 <!--コメントフォーム-->
        
      　 　 <form class="mb-4" method="POST" action="/posts/{{$post->id}}/comments">
   　           @csrf
 
    　　　         <input name="post_id" type="hidden" value="{{ $post->id }}" >
 
   　　　          <div class="form-group">
                    <label for="subject">名前</label>
 
　　　　　　　      <input id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" type="text" >
                    
                    
                   @if ($errors->has('name'))
                       <div class="invalid-feedback">
                           {{ $errors->first('name') }}
                       </div>
                   @endif
               </div>
 
               <div class="form-group">
                   <label for="body">本文</label>
 
                    <textarea
                       id="comment"
                       name="comment"
                       class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
                       rows="4"
                       >{{ old('comment') }}
                    </textarea>
                    
                    @if ($errors->has('comment'))
                       <div class="invalid-feedback">
                           {{ $errors->first('comment') }}
                       </div>
                    @endif
               </div>
 
                <div class="mt-4">
                   <button type="submit" class="btn btn-primary">コメントする</button>
                </div>
          
           </form>
 
           
     　　  
      　　　 <div class = 'back'>[<a href='/'>戻る</a>]</div>
       
      　　　 <script>
          　　　 function deletePost(e) {
             　　　  'use strict';
             　　　  if (confirm('削除すると復元できません。')) {
                   document.getElementById('form_delete').submit();
                  } 
                }
      　　 </script>
      　　  
      　@endsection
    </body>
</html>


           
