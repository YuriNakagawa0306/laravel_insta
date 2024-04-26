<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoryController;

Auth::routes();

Route::group(["middleware"=>"auth"],function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    // posts
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/show/{id}',[PostController::class, 'show'])->name('post.show');
    Route::get('/post/edit/{id}',[PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/update/{id}',[PostController::class, 'update'])->name('post.update');
    Route::delete('/post/destroy/{id}',[PostController::class, 'destroy'])->name('post.destroy');

    // comments
    Route::post('/comment/store/{id}', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/delete/{comment}',[CommentController::class, 'destroy'])->name('comment.delete');

    // profile
    Route::get('/profile/show/{id}',[ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit/{id}',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update',[ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}/followers',[ProfileController::class, 'showFollowers'])->name('show.followers');
    Route::get('/profile/{id}/followings',[ProfileController::class, 'showFollowings'])->name('show.followings');

    // likes
    Route::post('/like/store/{id}', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/delete/{like}',[LikeController::class, 'destroy'])->name('like.delete');

    // follow
    Route::post('/follow/store/{id}', [FollowController::class,'store'])->name('follow.store');
    Route::delete('/follow/delete/{id}',[FollowController::class, 'destroy'])->name('follow.delete');

    // admin
    Route::get('/admin/show/users', [UserController::class, 'showAllUsers'])->name('admin.users');
    Route::delete('/admin/deactivate/user{id}', [UserController::class, 'deactivate'])->name('admin.deactivate.users');
    Route::post('/admin/activate/user{id}', [UserController::class, 'activate'])->name('admin.activate.users');

    Route::get('/admin/show/posts', [PostsController::class, 'showAllPosts'])->name('admin.posts');
    Route::delete('/admin/deactivate/post{id}', [PostsController::class, 'deactivate'])->name('admin.deactivate.posts');
    Route::post('/admin/activate/post{id}', [PostsController::class, 'activate'])->name('admin.activate.posts');

    Route::get('/admin/show/categories', [CategoryController::class, 'showAllCategories'])->name('admin.categories');
    Route::post('/admin/store/category', [CategoryController::class, 'store'])->name('admin.store.category');
});

