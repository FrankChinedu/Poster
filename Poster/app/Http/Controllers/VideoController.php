<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VideoAddRequest;
use App\Model\Video;
use App\Model\Comment;
use App\Model\Post;

class VideoController extends Controller
{
    public function createVideo(VideoAddRequest $request)
    {
        $request->validated();

        $media = $request->file('file');

        $media = $this->storeMedia($media);

        try {
            $post = new Video();
            $post->url = $media['url'];

            $post->user_id = Auth::id();
            $post->save();

            return back()->with('status', 'post created');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id){
        $video = Video::findorfail($id);
        return view(
            'videos.show',
            [
                'video' => $video,
            ]
        );

    }

    public function delete(Request $request, $id){

        $post = Post::findorfail($id);

        if (Auth::check() && Auth::id() == $post->user_id) {
            try {
                $post->delete();
                return redirect()->to('/')->with('status', 'Post deleted');
            } catch (\Exception $e) {
                $e->getMessage();
            }
        }
        return back()->with('status', 'Unauthorized Access');
    }

    private function storeMedia($media)
    {

        $name = seoUrl($media->getClientOriginalName());
        $ext = $media->getClientOriginalExtension();

        $fileName = $name . time() . '.' . $ext;

        Storage::disk('uploads')->put($fileName, file_get_contents($media));
        $url = '/uploads/' . $fileName;

        return ['url' => $url];
    }
}
