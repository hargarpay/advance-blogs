<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['comment', 'user_id', 'post_id'];

    public function post(){
    	return $this->belongsTo('App\Post');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function getCreatedAtFormatAttribute($value){
    	return \Carbon\Carbon::parse($this->created_at)->format('jS F, Y');
    }
}
