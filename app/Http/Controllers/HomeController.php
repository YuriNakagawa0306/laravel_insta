<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $post;
    private $user;
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_posts = $this->post->latest()->get();
        $all_users = $this->user->all();
        $suggested_users = $this->suggestedUsers();
        $home_posts = $this->homePosts();

        return view('users.home')
                ->with('all_posts', $all_posts)
                ->with('all_users', $all_users)
                ->with('suggested_users', $suggested_users)
                ->with('home_posts', $home_posts);
    }

    public function suggestedUsers(){
        $all_users = User::all();
        $suggested_users = [];

        foreach ($all_users as $user) {
            if (!$user->isFollowed() && $user->id != Auth::id()) {
                $suggested_users[] = $user;
            }
        }

        return $suggested_users;
    }

    public function homePosts(){
        $all_posts = $this->post->latest()->get();
        $home_posts = [];

        foreach ($all_posts as $post) {
            if($post->user->isFollowed() || $post->user_id == Auth::id()){
                $home_posts[] = $post;
            }
        }

        return $home_posts;
    }
}
