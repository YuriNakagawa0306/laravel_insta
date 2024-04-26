<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function category_post(){
        return $this->hasMany(CategoryPost::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
        #select * from likes where post_id = ??
    }

    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
        #SELECT * FROM likes WHERE post_id ?? AND WHERE user_id == ??
            #exists returns true or false
    }
}
