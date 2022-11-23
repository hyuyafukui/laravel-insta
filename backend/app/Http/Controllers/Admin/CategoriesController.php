<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category, Post $post)
    {
        $this->category = $category;
        $this->post = $post; 
    }

    public function index()
    {
        $all_categories = $this->category->all();

        $all_posts = $this->post->all();
        $uncategorized_count = 0;
        foreach($all_posts as $post){
            if($post->categoryPosts->count()  == 0){
                $uncategorized_count++;
            }

        }

        return view('admin.categories.index')
                ->with('all_categories', $all_categories)
                ->with('uncategorized_count', $uncategorized_count);
    }

    public function store(Request $request)
    {
        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'new_name' => 'required|max:50|unique:categories,name,'.$id
        ]);

        $categ = $this->category->findOrFail($id);
        $categ->name = $request->new_name;
        $categ->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->category->destroy($id);

        return redirect()->back();
    }
}
