<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post){
        $this->post = $post;
    }

    public function showAllPosts(){
        $all_posts = $this->post->withTrashed()->get();

        return view('users.admin.posts')
                ->with('all_posts', $all_posts);
    }

    public function deactivate($id){
        $post = $this->post->findOrFail($id);
        $post->delete();

        return redirect()->back();
    }

    public function activate($id){
        $post = $this->post->withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back();
    }
}
