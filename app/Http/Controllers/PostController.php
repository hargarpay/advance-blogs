<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use Validator;

class PostController extends Controller
{
    public function __construct(){
    	
    }

    public function view(){
    	$title = "View Posts";
    	$posts = Post::paginate(10);
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
    	return view('posts.create', compact('title'));
    }

    public function store(Request $request){
    	$validate = Validator::make($request->all(), ['title' => 'required|min:5', 'description' => 'required|min:20']);
    	if($validate->passes()){
    		Post::create([
    				'title' => $request->input('title'),
    				'description' => $request->input('description'),
    				'user_id' => auth()->id()
    			]);

    		flash('Successfully, created the post')->success();
    		return redirect()->route('view.posts');
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
    	$validate = Validator::make($request->all(), ['title' => 'required|min:5', 'description' => 'required|min:20']);

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
    	return redirect()->back();
    }

    public function untrash(Post $post){
    	$post->restore();
    	flash('Successfully, restore post')->success();
    	return redirect()->back();
    }

    public function permanentDelete(Post $post){
    	$post->forceDelete();
    	flash('Successfully, restore post')->success();
    	return redirect()->back();
    }

    public function publish(Post $post){
        $post->published = 1;
        $post->save();
        flash('Successfully, published post')->success();
        return redirect()->back();
    }

    public function draft(Post $post){
        $post->published = 0;
        $post->save();
        flash('Successfully, drafted post')->success();
        return redirect()->back();
    }

}
