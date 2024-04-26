<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class LikeController extends Controller
{
    //
    private $like;
    public function __construct(Like $like){
        $this->like = $like;
    }

    // public function store(Request $request, $id){
    //     $post = Post::findOrFail($id);

    //     $this->like->post_id = $id;
    //     $this->like->user_id = Auth::id();
    //     if($post->likes()->where('user_id', Auth::id())->exists()){
    //         $post->likes()->where('user_id', Auth::id())->delete();
    //     }else{
    //         $this->like->save();
    //     }

    //     return redirect()->back();
    // }

    public function store(Request $request, $id){
        $this->like->post_id = $id;
        $this->like->user_id = Auth::id();
        $this->like->save();

        return redirect()->back();
    }
    public function destroy($post_id){
        $this->like->where('post_id', $post_id)->where('user_id', Auth::id())->delete();

        return redirect()->back();
    }
}
