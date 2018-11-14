<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Comment;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostMediaRequest;
use App\Http\Requests\PostTextRequest;

class PostController extends Controller
{
    public function index(){
        return view('posts.index');
    }

    public function create(){
        return view('posts.create');
    }

    public function show($post_id) {
        $post = Post::findorfail($post_id);
        return view('posts.show',
        [
            'post' => $post,
        ]
        );
    }

    public function delete(Request $request, $id) {
        
        $post = Post::findorfail($post_id);

        if(Auth::check() && Auth::id() == $post->user_id ) {
            try{
                $post->delete();
                return redirect()->to('/')->with('status', 'Post deleted');
            }catch(\Exception $e) {
                $e->getMessage();
            }
        }
        return back()->with('status', 'Unauthorized Access');
    }


    public function createPost(PostTextRequest $request) {
        $request->validated();

        try {
            $post = new Post();
            $post->text = $request->text;
            $post->user_id = Auth::id();
            $post->save();
    
            return back()->with('status', 'post Text created');

        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }




}
