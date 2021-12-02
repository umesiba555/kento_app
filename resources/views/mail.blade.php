<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
       

        <title>blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
<body>
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
        {{$image_path}}
    </pre>
</body>
</html>