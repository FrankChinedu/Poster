<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;
use App\Model\Comment;
use Storage;
use Illuminate\Support\Facades\Auth;

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
            'comments' => $comments]
        );
    }

    public function delete(Request $request, $id) {
        Post::findorfail($id)->delete();
        return redirect()->to('/');
    }

    public function add(Request $request) {
        // return $request->all();

        $post = new Post();
        if($request->field == '_text') {
            $this->validate($request, [
                'text' => 'required|min:3'
            ]);

            $post->text = $request->text;
            $post->type = 'text';
        }

        if($request->field == 'vid_pic') {
            $this->validate($request, [
                'file' => 'required|mimes:jpeg,png,jpg,bmp,gif,svg,mp4|max:10000'
            ]);

            $media = $request->file('file');

            $name = $this->seoUrl($media->getClientOriginalName());
            $ext = $media->getClientOriginalExtension();

            $fileName = $name . time() . '.' . $ext;

            if($ext === 'mp4') {
                $post->type = 'video';
            } else {
                $post->type = 'image';
            }

            Storage::disk('uploads')->put($fileName, file_get_contents($media));
            $url = '/uploads/'. $fileName;
            $post->url = $url;
        }

        $post->user_id = Auth::id();
        $post->save();

        return back()->with('status', 'post created');

    }

    private function seoUrl($string)
    {
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }


}
