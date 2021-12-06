
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
       　
       　<div class= "head_title">
       　   <h1>Posts Details</h1>
       　</div>
   
       
      <p class="edit">[<a href="/posts/{{ $Auth_user->id }}/edit">編集</a>]</p>
      
      　　　 <form action="/posts/{{ $Auth_user->id }}" id="form_delete" method="post">
          　　　  @csrf
          　　  　@method('delete')
          
          
            @if (Auth::user()->id == $Auth_user->user_id)
              <input type="submit" style="display:none">
              <p class='delete'>[<span onclick="return deletePost(this);">削除</span>]</p>
            @endif
            
      　　　 </form>
      　　　 
      　　　 　 @if ($Auth_user->is_approved)
      　    　　<h1 class="apply_posts">＊＊この投稿は承認済み＊＊</h1>
             @endif
       
       
       　　　<div class = 'post'>
          　　 <h1>・{{ $Auth_user -> title }}</h1>
          　　 <p>投稿者:{{ $Auth_user->user->name }}</p>
          　　 <p >衣装の説明：{{ $Auth_user -> body }}<p>
          　
          　　 <h3>＃タグ一覧</h3>
            <div class= "tags">
               
              @if (Session::has('new_post'))
                     @foreach(session('new_post') as $n_p)
                      @if($n_p->genre)
                         <p><span>#<span>{{ $n_p->genre }}</p>
                      @endif 
                       @if($n_p->color)
                         <p><span>#<span>{{ $n_p->color }}</p>
                      @endif 
                       @if($n_p->category)
                         <p><span>#<span>{{ $n_p->category }}</p>
                      @endif 
                       @if($n_p->pattern)
                         <p><span>#<span>{{ $n_p->pattern }}</p>
                      @endif 
                     @endforeach
               @endif
            
           
             @if ($select_tags[0]->genre)
                <p><span>#<span>{{ $select_tags[0]->genre }}</p>
             @endif
             @if ($select_tags[2]->color)
                <p><span>#<span>{{ $select_tags[2]->color }}</p>
             @endif
             @if ($select_tags[3])
                <p><span>#<span>{{ $select_tags[3]->pattern }}</p>
             @endif
             @if ($select_tags[1])
                <p><span>#<span>{{ $select_tags[1]->category }}</p>
             @endif   
           </div>
            
                  
             <p class = 'updated_at'>投稿日：{{ $Auth_user -> updated_at }}</p>
          　
          　
          　　　 @if ($Auth_user->image_path)
                     <img src="{{ $Auth_user->image_path }}">
               @endif
               
            
      　　　 </div>
      　　
      　　
      　　　 <!--いいねボタン-->
        <div class="likes">
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
           
              <p>いいね!数[{{$Auth_user->like_users->count()}}]件</p>
         
       </div>  
        
        
        <!--申請-->
        <div class="apply">
           @if (Auth::id() != $Auth_user->user->id)
            

               @if (Auth::user()->is_apply($Auth_user->id))
                
                   <form class="mb-4" method="POST" action="{{route('applies.unapply',['post'=> $Auth_user->id])}}">
   　                    @csrf
   　                    @method('DELETE')
   　                    <input name="post_id" type="hidden" value="{{ $Auth_user->id}}" >
   　                   
   　                    <div class="mt-4">
                          <button type="submit" class="btn btn-primary">「リクエスト中．．．」</button>
                        </div>
   　                  
   　             　</form>
   　               
   　           @else
       　            <form class="mb-4" method="POST" action="{{route('applies.apply',['post'=> $Auth_user->id])}}">
       　                    @csrf
       　                    <input name="post_id" type="hidden" value="{{ $Auth_user->id }}" >
       　                    <div class="mt-4">
                                <button type="submit" class="btn btn-primary">「レンタルリクエスト」</button>
                            </div>
   　                </form>
                @endif
           @endif
           
           
           <!--承認ボタン-->
           @foreach($Auth_user->apply_users as $apply_user)
             
              
               @if(Auth::id() == $Auth_user->user->id)
              
                   @if (!($Auth_user->is_approved))
                    <p1>{{$apply_user->name}}</p1>
                    
                    
                       <form class="mb-4" method="POST" action="?">
                          
       　                    @csrf
       　                    <input name="post_id" type="hidden" value="{{ $Auth_user->id}}" >
       　                    
       　                    <div class="mt-4">
                              <button type="submit" formaction="{{route('apply.approved',['post'=> $Auth_user->id,'apply'=> $apply_user->id])}}"  class="btn btn-primary">「リクエスト承認」</button>
                            </div>
                         
                          　
       　                  
       　               </form>
       　           @endif
       　      @endif
       　@endforeach
         
         
         <!--承認取り消し-->
    @if(Auth::id() == $Auth_user->user->id)
      @if($Auth_user->is_approved)
                   <p>{{$post->name}}</p>
           　          
           　          <form class="mb-4" method="POST" action="{{route('apply.unapproved',['post'=> $Auth_user->id,'apply'=> $apply_user->id])}}">
                              
           　          @csrf
           　          @method('delete')
           　         <input name="post_id" type="hidden" value="{{ $Auth_user->id}}" >
           　                    
           　          <div class="mt-4">
                        <button type="submit" class="btn btn-primary">「承認」を取り消す</button>
                      </div>
                     </form>
    　 @endif
    @endif
        </div> 
        
    
       
      
      <!--mail-->
       @if($Auth_user->is_approved)
         <form class="mb-4 postsend" method="POST" action="{{route('mail')}}"
         enctype="multipart/form-data">
   　           @csrf
            @if(isset($post->email))
              <input name="mailsend" type="hidden" value="{{$post->email}}">
            @endif
            @if(isset($post->name))
              <input name="name" type="hidden" value="{{$post->name}}">
            @endif
            @if(isset($Auth_user->user->name))
              <input name="create_user" type="hidden" value="{{$Auth_user->user->name}}">
            @endif
             @if(isset($Auth_user->user->email))
              <input name="create_user_email" type="hidden" value="{{$Auth_user->user->email}}">
            @endif
            @if(isset($Auth_user->title))
              <input name="post_title" type="hidden" value="{{$Auth_user->title}}">
            @endif
            @if(isset($Auth_user->body))
              <input name="post_body" type="hidden" value="{{$Auth_user->body}}">
            @endif
            @if(isset($Auth_user->image_path))
              <input name="image_path" type="hidden" value="{{$Auth_user->image_path}}">
            @endif
   　　　          <div class="form-group">
                    <label for="subject">件名</label>
 
                    <input id="title" name="title" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" type="text" >
                    
                   @if ($errors->has('name'))
                       <div class="invalid-feedback">
                           {{ $errors->first('name') }}
                       </div>
                   @endif
               </div>
 
               <div class="form-group">
                   <label for="body">本文</label>
 
                    <textarea
                       id="content"
                       name="content"
                       class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
                       rows="4"
                       >{{ old('comment') }}
                    </textarea>
                    
               </div>
 
                <div class="mt-4">
                   <button type="submit" class="btn btn-primary">送信</button>
                </div>
          
         </form>
       @endif 

        
        <div class="comments">　 
      　　 <p>【コメント一覧】</p>
                <div class="comment">
                   @foreach($Auth_user->comments as $comment) 
              　　  　 <p>名前:{{$comment->name }}</p>
              　　     <p>本文:{{$comment->body }}</p>
                   @endforeach
          　　 　 </div>
      　
      　　　 
   　　　　　　　　　　　　　 <!--コメントフォーム-->
        
        <form class="mb-4" method="POST" action="/posts/{{ $post_id }}/comments">
   　           @csrf
            <input name="popost_id" type="hidden" value="{{ $post_id }}" >
 
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
        </div>
           
     　　  
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


     
