<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
       

        <title>blog</title>

    
    <style>
        .mail{
             width: 500px;
             height: 500px;
             background-color: #fff;
             margin-bottom: 30px;
             border-radius:10px;
             margin-left: auto;
             margin-right: auto;
             text-align: center;
        }
        .mail img{
            width: 450px;
            height: 550px;
            border-radius:10px;
            text-align: left;
        }
    </style>
    
    </head>
<body>
    <div class='mail'>
        <h1>{{$name}}様</h1>
        <pre>
            [件名]{{$title}}
            [本文]{{$content}}
            
            ***衣装を円滑に交換するために、[投稿者]までご連絡ください。
             [ {{$create_user_email}} ]<<==こちらまで***
            
            
            
            【承認された投稿】
            [投稿者]{{$create_user}}
            [タイトル]{{$post_title}}
            [紹介文]{{$post_body}}
            <img src="{{$image_path}}" alt="投稿画像">
        </pre>
        
       
    </div>
    
</body>
</html>