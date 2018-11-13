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

    public function addPostComment (CommentAddRequest $request, $id){
        
        $type = 'App\Model\Post';
        $info = $this->saveComment($request, $id, $type);

        return back()->with('status',$info);
    }

    public function addVideoComment(CommentAddRequest $request, $id)
    {
        $type = 'App\Model\Video';
        $info = $this->saveComment($request, $id, $type);

        return back()->with('status', $info);
    }

    public function saveComment($request,$id, $type) {
        $request->validated();

        try {
            $comment = new Comment();
            $comment->body = $request->body;
            $comment->user_id = Auth::id();
            $comment->commentable_type = $type;
            $comment->commentable_id = $id;
            $comment->save();

            return  'comment added';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    

    public function delete(Request $request, $comment_id) {
        $comment = Comment::findorfail($comment_id);

        if (Auth::check() && Auth::id() == $comment->user_id) {
            try{
                $comment->delete();
                return back()->with('status', 'comment deleted successfully');
            }catch(\Exception $e) {
                return $e->getMessage();
            }
        }
        return back();
    }

}
