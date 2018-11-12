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
        $comments = Comment::where('post_id', $post_id )->latest()->get();
        return view('posts.show',
        [
            'post' => $post,
            'comments' => $comments
        ]
        );
    }

    public function delete(Request $request, $id) {
        $isOwner = $this->isOwner($id);
        
        if($isOwner) {
            Post::findorfail($post_id)->delete();
            return redirect()->to('/')->with('status', 'Post deleted');
        }
        return back()->with('status', 'Unauthorized Access');
    }

    private function isOwner($post_id){
        $post = Post::findorfail($post_id);
        $owner = $post->user_id;

        if (Auth::id() == $owner) {
            return true;
        }
        return false;
    }

    public function addText(PostTextRequest $request) {
        $request->validated();

        try {
            $post = new Post();
            $post->text = $request->text;
            $post->type = 'text';
            $post->user_id = Auth::id();
            $post->save();
    
            return back()->with('status', 'post Text created');

        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function addMedia(PostMediaRequest $request) {
        $request->validated();
        
        $media = $request->file('file');

        $media = $this->storeMedia($media);

        try {
            $post = new Post();
            $post->url = $media['url'];
            $post->type = $media['type'];
    
            $post->user_id = Auth::id();
            $post->save();
    
            return back()->with('status', 'post created');

        }catch(\Exception $e) {
            return $e->getMessage();
        }
        
    }

    private function storeMedia($media){

        $name = seoUrl($media->getClientOriginalName());
        $ext = $media->getClientOriginalExtension();

        $fileName = $name . time() . '.' . $ext;

        if ($ext === 'mp4') {
            $type = 'video';
        } else {
            $type = 'image';
        }

        Storage::disk('uploads')->put($fileName, file_get_contents($media));
        $url = '/uploads/' . $fileName;

        return ['url'=> $url, 'type'=> $type];
    }


}
