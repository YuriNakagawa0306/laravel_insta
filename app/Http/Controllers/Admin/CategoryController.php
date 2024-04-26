<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function showAllCategories(){
        $all_categories = $this->category->all();

        return view('users.admin.categories')
                ->with('all_categories', $all_categories);
    }

    public function store(Request $request){
        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }
}
