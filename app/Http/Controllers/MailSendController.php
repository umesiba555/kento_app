<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SampleNotification;
use App\Post;


class MailSendController extends Controller
{
    public function send(Request $request) {
       //dd($request);
        $name = $request->name;
        $title = $request->title;
        $content = $request->content;
        $create_user = $request->create_user;
        $create_user_email = $request->create_user_email;
        $post_title = $request->post_title;
        //dd($post_title);
        $post_body = $request->post_body;
        $image_path = $request->image_path;
        $mail_to_user = $request->mailsend;
        Mail::to($mail_to_user)->send(new MailController($name, $title, $content, $create_user, $create_user_email, $post_title, $post_body, $image_path));
        return redirect('/');
    }
}
