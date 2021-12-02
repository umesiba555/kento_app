<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailController extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     protected $name;
     protected $title;
     protected $content;
     protected $create_user;
     protected $create_user_email;
     protected $post_title;
     protected $post_body;
     protected $image_path; 
    
    public function __construct($name, $title, $content, $create_user, $create_user_email, $post_title, $post_body, $image_path)
    {
        $this->name = $name;
        $this->title = $title;
        $this->content = $content;
        $this->create_user = $create_user;
        $this->create_user_email = $create_user_email;
        $this->post_title = $post_title;
        $this->post_body = $post_body;
        $this->image_path = $image_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // dd($this->content);
        return $this
        ->view('mail')
        ->from('kento883@icloud.com')
        ->with([
            'name'=>$this->name,
            'title'=> $this->title,
            'content'=>$this->content,
            'create_user'=>$this->create_user,
            'create_user_email'=>$this->create_user_email,
            'post_title'=>$this->post_title,
            'post_body'=>$this->post_body,
            'image_path'=>$this->image_path,
            ]);
    }
}
