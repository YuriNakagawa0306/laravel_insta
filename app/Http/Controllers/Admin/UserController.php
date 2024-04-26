<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function showAllUsers(){
        $all_users = $this->user->withTrashed()->get();

        return view('users.admin.users')
                ->with('all_users', $all_users);
    }

    public function deactivate($id){
        $user = $this->user->findOrFail($id);
        $user->delete();

        return redirect()->back();
    }

    public function activate($id){
        $user = $this->user->withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back();
    }
}
