<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment) //$comment = new Comment
    {
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id)
    {
        $request->validate([
            'comment_body'.$post_id => 'required|min:1|max:100'
        ],
        [
            'comment_body'.$post_id.'.required' => 'Cannot post an empty comment',
            'comment_body'.$post_id.'.max' =>'Maximum 100 characters only'
        ]);

        $this->comment->body = $request->input('comment_body'.$post_id); //$request->comment_body;
        $this->comment->post_id = $post_id;
        $this->comment->user_id = Auth::user()->id;
        $this->comment->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
