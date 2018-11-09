<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Post;

class IndexController extends Controller
{
    public function index(Post $post){
        $posts =  $post::latest()->paginate(20);
        return view('home', [
            'posts' => $posts
        ]);
    }
}
