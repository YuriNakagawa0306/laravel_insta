<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id){
        $user = $this->user->findOrFail($id);
        $all_posts = $user->posts;

        return view('users.profile.show')->with('user', $user)
                ->with('all_posts', $all_posts);
    }

    public function edit($id){
        if(Auth::id() != $id){
            return redirect()->route('index');
        }

        $user = $this->user->findOrFail($id);

        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request){
        $user = $this->user->findOrFail(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->avatar){
            $user->avatar = 'data:avatar/'.$request->avatar->extension().';base64,'.base64_encode(file_get_contents($request->avatar));
        }
        $user->save();

        return redirect()->route('profile.show', $user->id);
    }

    public function showFollowers($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.followers')
                ->with('user', $user);
    }

    public function showFollowings($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.followings')
                ->with('user', $user);
    }
}
