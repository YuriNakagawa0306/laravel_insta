<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;
    private $category;
    
    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $all_categories = $this->category->get();

        return view('users.posts.create')
                ->with('all_categories', $all_categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        //save to Post table
        $this->post->user_id = Auth::id();
        $this->post->description = $request->description;
        $this->post->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        $this->post->save();

        // save to CategoryPost table
        foreach ($request->category as $category_id) {
            $category_post[] = ['category_id' => $category_id];
        }
        $this->post->category_post()->createMany($category_post);
        // create many is a loop that will save multiple data

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $post = $this->post->findOrFail($id);

        return view('users.posts.show')
                ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $post = $this->post->findOrFail($id);
        $all_categories = $this->category->get();
        $selected_categories = [];

        foreach ($post->category_post as $category_post) {
            $selected_categories[] = $category_post->category_id;
        }

        // return $selected_categories;

        return view('users.posts.edit')->with('post', $post)
                ->with('all_categories', $all_categories)
                ->with('selected_categories', $selected_categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $post = $this->post->findOrFail($id);
        $post->user_id = Auth::id();
        $post->description = $request->description;
        if($request->image){
            $post->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        }
        $post->save();

        #delete categories connected to this post
        $post->category_post()->delete();
        foreach ($request->category as $category_id) {
            $category_post[] = ["category_id" => $category_id];
        }

        $post->category_post()->createMany($category_post);
        //create many is a loop that will save multiple data

        return view('users.posts.show')->with('post', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // route-model binding
        // $post->delete();
        // return redirect()->route('index');

        $this->post->destroy($id);

        return redirect()->route('index');
    }
}
