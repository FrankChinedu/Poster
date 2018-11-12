<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentAddRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function add (CommentAddRequest $request, $post_id){
        
        $request->validated();

        try {
            $comment = new Comment();
            $comment->name = $request->name;
            $comment->comment = $request->comment;
            $comment->post_id = $post_id;
            $comment->save();
    
            return back()->with('status', 'comment added');
        }catch (\Exception $e){
            $e->getMessage();
        }
    }

    public function delete(Request $request, $comment_id) {

        $isOwner = $this->isOwner($comment_id);

        if ($isOwner) {
            Comment::findorfail($comment_id)->delete();
            return back()->with('status', 'comment deleted successfully');
        }
        
        return back();
    }

    private function isOwner($comment_id)
    {
        $comment = Comment::findorfail($comment_id);
        $owner = $comment->post->user_id;

        if (Auth::id() == $owner) {
            return true;
        }
        return false;
    }
}
