<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use Validate;

class PostController extends Controller
{
    public function __construct(){
    	
    }

    public function view(){
    	$title = "View Posts";
    	$posts = Post::all();
    	return view('posts.view', compact('title', 'posts'));
    }

    public function viewTrash(){
    	$title = "View Posts";
    	$posts = Post::onlyTrashed()
    				->get();
    	return view('posts.view', compact('title', 'posts'));
    }

    public function create(){
    	$title = "Create Post";
    	return view('posts.view', compact('title'));
    }

    public function store(Request $request){
    	$validate = Validator::make($request->all(), ['title' => 'required', 'description' => 'required']);
    	if($validate->passes()){
    		Post::create([
    				'title' => $request->input('title'),
    				'description' => $request->input('description'),
    				'user_id' => auth()->id()
    			]);

    		flash('Successfully, created the post')->success();
    		return redirect()->route('view.post');
    	}
    	flash('Something is wrong')->error();
    	return redirect()->back()
    					->withErrors($validate)
    					->withInput();
    }

    public function edit(Post $post){
    	$title = "Edit ".strtoupper($post->title);
    	return view('posts.edit', compact('title', 'post'));
    }


    public function update(Request $request, Post $post){
    	$validate = Validator::make($request->all(), ['title' => 'required', 'description' => 'required']);

    	if($validate->passes()){
    		$post->title = $request->input('title');
    		$post->description = $request->input('description');
    		$post->save();
    		flash('Successfully, updated post')->success();
    		return redirect()->back();
    	}

    	flash('Something is wrong')->error();
    	return redirect()->back()
    					->withErrors($validate)
    					->withInput();
    }

    public function trash(Post $post){
    	$post->delete();
    	flash('Successfully, trashed post')->success();
    	return redirecr()->back();
    }

    public function untrash(Post $post){
    	$post->restore();
    	flash('Successfully, restore post')->success();
    	return redirecr()->back();
    }

    public function permanentDelete(Post $post){
    	$post->forceDelete();
    	flash('Successfully, restore post')->success();
    	return redirecr()->back();
    }

}
