<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
    ];
    
    public function getPaginate($limit_count = 10) 
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
        
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    public function like_users()
    {
        return $this->belongsToMany(User::class,'likes','post_id','user_id')->withTimestamps();
    }
    
    public function apply_users()
    {
        return $this->belongsToMany(User::class,'applies','post_id','user_id')->withTimestamps();
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    
}

