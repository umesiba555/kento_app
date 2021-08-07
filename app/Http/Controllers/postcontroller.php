<?php

namespace App\Http\Controllers;

use app\post;
use Illuminate\Http\Request;

class postcontroller extends Controller
{
    public function index(Post $post)
    {
       return $post->get();
    }
}
