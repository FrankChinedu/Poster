<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Comment;

class CommentController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');    
    }

    public function add (Request $request, $post_id){

        $this->validate($request, [
            'name' => 'required',
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->comment = $request->comment;
        $comment->post_id = $post_id;
        $comment->save();

        return back();
    }

    public function delete(Request $request, $comment_id) {
        Comment::findorfail($comment_id)->delete();
        return back();
    }
}
