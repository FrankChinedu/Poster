<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;
use Illuminate\Support\Facades\DB;
use App\Model\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->take(20)->get();
        $videos = Video::latest()->take(20)->get();
        
        return view('home', [
            'videos'=>$videos,
            'posts' => $posts
        ]);
    }
}
