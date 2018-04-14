<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['name', 'description', 'user_id'];

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
