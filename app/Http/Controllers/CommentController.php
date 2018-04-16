<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\Comment;

use App\Events\WebsocketEvent;

class CommentController extends Controller
{
    public function __construct(){
    	$this->middleware('auth', ['except' => ['getComments']]);
    }

    public function getComments(Post $post){
		return response()->json($post->comments()->with('user')->latest()->get());
	}

	public function store(Request $request, Post $post){

		$comment = $post->comments()->create([
				'user_id' => auth()->id(),
				'comment' => $request->input('comment')
			]);

		$comment = Comment::where('id', '=', $comment->id)->with('user')->first();

		broadcast(new WebsocketEvent($comment))->toOthers();
		return  $comment->toJson();
	}
}
