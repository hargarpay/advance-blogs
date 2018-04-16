<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Homepage';
        $posts = Post::paginate(10);
        return view('home', compact('title', 'posts'));
    }

    public function blogPost(Post $post){
        $title = 'View '.$post->title;
        return view('post', compact('title', 'post'));
    }
}
