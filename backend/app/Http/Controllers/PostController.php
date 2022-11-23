<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function create()
    {
        $all_categories = $this->category->latest()->get();
        return view('users.posts.create')
            ->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|array|between:1,3',
            //array - makes the sure the data is an array
            //between - accepts number of items in the array
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:jpeg,jpg,gif|max:1048'
            //mimes - limits file types
            //max - file size
        ]);

        $this->post->description = $request->description;
        $this->post->image = $this->saveImage($request);
        $this->post->user_id = Auth::user()->id;
        $this->post->save();

        foreach($request->category as $category_id){
            $category_posts[] = ['category_id' => $category_id];
        }
        // //create()
        // $array=[
        //     'category_id' =1,
        //     'post_id' =3
        // ];
        // $this->categoryPost->create(array);
        $this->post->categoryPosts()->createMany($category_posts);

        return redirect()->route('home');

    }

    private function saveImage($request)
    {
        $file_name = time().".".$request->image->extension();

        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $file_name);

        return $file_name;

    }

    public function show($id)
    {
        $post_a = $this->post->findOrFail($id);

        return view('users.posts.show')
                    -> with('post', $post_a);
    }

    public function edit($id)
    {
        $post_a = $this->post->findOrFail($id);
        $all_categories = $this->category->all();

        $selected_categories = [];

        foreach($post_a->categoryPosts as $categoryPost){
            $selected_categories[] = $categoryPost->category_id;
        }

        return view('users.posts.edit')
                ->with('post', $post_a)
                ->with('all_categories', $all_categories)
                ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|array|between:1,3',
            //array - makes the sure the data is an array
            //between - accepts number of items in the array
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:jpeg,jpg,gif|max:1048'
            //mimes - limits file types
            //max - file size
        ]);

        $post_a = $this->post->findOrFail($id);

        $post_a->description = $request->description;
        if($request->image) //checks if there is an image file in the form
        {
            //delete the current image
            $this->deleteImage($post_a->image);

            //save new image
            $post_a->image = $this->saveImage($request);
        }
        $post_a->save();

        //delete current categoryPosts
        $post_a ->categoryPosts()->delete(); //multiple delete/destroy

        //add new categoryPosts
        foreach($request->category as $categ_id){
            $category_post[] = ['category_id' => $categ_id];
        }

        $post_a->categoryPosts()->createMany($category_post);

        return redirect()->route('post.show', $id);
    }

    private function deleteImage($file_name)
    {
        $file_path = self::LOCAL_STORAGE_FOLDER . $file_name;

        if(Storage::disk('local') ->exists($file_path)){
            Storage::disk('local')->delete($file_path);
        }
    }

    public function delete($id)
    {
        $post_a = $this->post->findOrFail($id);

        //delete the image first
        $this->deleteImage($post_a->image);

        //delete the post
        $post_a->forceDelete();

        return redirect()->route('home');
    }
    
}
