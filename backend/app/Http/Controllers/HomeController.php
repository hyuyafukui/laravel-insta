<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $post;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->search) //check if there is a search word
        {   
            $all_posts = $this->post
                        ->where('description', 'LIKE', '%'.$request->search.'%')
                        ->latest()->get();
        }else{
            $all_posts = $this->post->latest()->get();
            //gets all data ordered by date( latest first)
        }

        //get only posts from followed users or your own
        $home_posts = [];
        foreach ($all_posts as $p) {
            if ($p->user->isFollowed() || $p->user_id == Auth::user()->id) {
                $home_posts[] = $p;
            }
        }

        $suggested_users = $this->getSuggestedUsers();

        return view('users.home')
            ->with('all_posts', $home_posts)
            ->with('suggested_users', $suggested_users)
            ->with('search', $request->search);
    }

    public function getSuggestedUsers()
    {
        //limit to 10

        //don't include logged-in user
        $users_list = $this->user->all()->except(Auth::user()->id);

        //only include users NOT followed yet
        $suggested_users = [];
        foreach ($users_list as $user) {
            if (!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }

        return $suggested_users;
    }

    public function SuggestedUsers(Request $request)
    {
        if($request->search){
            $users_list = $this->user
                        ->where('name', 'LIKE', '%'.$request->search.'%')
                        ->get()
                        ->except(Auth::user()->id);
                        //except() -> connects to all() or get()
          }else{
            $users_list = $this->user
                        ->all()
                        ->except(Auth::user()->id);
          }

        $suggested_users = [];
        foreach ($users_list as $user) {
            if (!$user->isFollowed()) {
                $suggested_users[] = $user;
            }       

        }



        return view('users.suggested-users')
            ->with('suggested_users', $this->getSuggestedUsers())
            ->with('search', $request->search);
    }
}
