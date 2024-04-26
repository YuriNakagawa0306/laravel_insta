<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function followerUser(){
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followingUser(){
        return $this->belongsTo(User::class, 'following_id');
    }
}
