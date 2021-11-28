<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', 'PostController@index');//記事一覧

Route::get('/posts/create', 'PostController@create')->middleware('auth');//新規投稿

Route::get('/posts/{post}/edit', 'PostController@edit');//編集

Route::put('/posts/{post}', 'PostController@update');

Route::delete('/posts/{post}', 'PostController@delete');//削除

Route::get('/posts/{post}', 'PostController@show')->middleware('auth');//記事詳細

Route::get('/posts/{post}/comments', 'CommentsController@store');
Route::post('/posts/{post}/comments', 'CommentsController@store');//コメント

Route::get('/posts', 'PostController@store');
Route::post('/posts', 'PostController@store');//投稿

Route::group(['middleware'=>'auth'],function(){
    Route::group(['prefix'=>'posts/{post}'],function(){
       Route::post('like','LikeController@store')->name('likes.like');//いいね
       Route::delete('unlike','LikeController@destroy')->name('likes.unlike');


       Route::post('apply','ApplyController@store')->name('applies.apply');//申請
       Route::delete('unapply','ApplyController@destroy')->name('applies.unapply');

        Route::post('approved/{apply}','ApplyController@approve')->name('apply.approved');//承認
        Route::delete('approved/{apply}','ApplyController@unapprove')->name('apply.unapproved');
        
    });

Route::get('/post/tags/{keyword}', 'PostController@tags')->name('tags');

});







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/postsent', 'PostController@postmail')->name('posts.email');
Route::post('/postsent', 'PostController@postmail')->name('posts.email');


//LINEの認証画面に遷移
// Route::get('auth/line', 'Auth\LineOAuthController@redirectToProvider')->name('line.login');
// // 認証後にリダイレクトされるURL(コールバックURL)
// Route::get('auth/line/callback', 'Auth\LineOAuthController@handleProviderCallback');



// Route::get('dashboard', 'DashboardController@index');

// Route::get('login', 'Auth\AuthController@redirectToProvider')->name('login');
// Route::get('callback', 'Auth\AuthController@handleProviderCallback');
// Route::post('logout', 'Auth\AuthController@logout')->name('logout');

//Route::view('/', 'index')->name('index');
Route::get('/linelogin/{provider}', 'Auth\LineLoginController@redirectToProvider')->name('linelogin');
Route::get('/linelogin/{provider}/callback', 'Auth\LineLoginController@handleProviderCallback');
Route::get('/logout', 'Auth\LineLoginController@logout')->name('logout');

