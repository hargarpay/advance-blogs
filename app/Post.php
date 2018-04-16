<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $table = 'posts';

    protected $fillable = ['title', 'description', 'user_id'];

    /**
    * The attributes that should be mutated to dates
    *
    **/
        protected $dates = ['deleted_at'];

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function getCreatedAtFormatAttribute($value){
    	return \Carbon\Carbon::parse($this->created_at)->format('jS M, Y');
    }
}
