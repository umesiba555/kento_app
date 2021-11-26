<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
          
          
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    
    public function posts() {
        return $this->hasMany('App\Post');
    }
    
    
    public function likes()
    {
        return $this->belongsToMany(post::class, 'likes','user_id','post_id')->withTimestamps();
    }
    
    public function is_like($postId)
    {
        return $this->likes()->where('post_id',$postId)->exists();
    }
    
    
    public function like($postId)
    {
        $exist = $this->is_like($postId);
        
        
        if($exist){
            return false;
        }else{
            $this->likes()->attach($postId);
            return true;
        }
        
    }
    
    public function unlike($postId)
    {
        $exist = $this->is_like($postId);
        
        if($exist){
            $this->likes()->detach($postId);
            return true;
        }else{
            return false;
        }
    }
    
    public function applies()
    {
        return $this->belongsToMany(post::class, 'applies','user_id','post_id')->withTimestamps();
    }
    
    public function is_apply($postId)
    {
        return $this->applies()->where('post_id',$postId)->exists();
    }
    
    
    public function apply($postId)
    {
        $exist = $this->is_apply($postId);
        
        
        if($exist){
            return false;
        }else{
            $this->applies()->attach($postId);
            return true;
        }
        
    }
    
    public function unapply($postId)
    {
        $exist = $this->is_apply($postId);
        
        if($exist){
            $this->applies()->detach($postId);
            return true;
        }else{
            return false;
        }
    }
    
   
    
    
}
