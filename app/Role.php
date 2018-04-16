<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;
	
    protected $table = 'roles';
 	
 	protected $fillable = ['name', 'slug', 'permissions'];

 	/**
    * The attributes that should be mutated to dates
    *
    **/
        protected $dates = ['deleted_at'];

 	public function users(){
 		return $this->belongsToMany('App\User', 'users_roles', 'role_id', 'user_id');
 	}

 	public function hasAccess($permission){
 		$permissions = json_decode($this->permissions, true);

 		return $permissions[$permission] === true ?  true : false;
 	}

 	public function getCreatedAtFormatAttribute($value){
    	return \Carbon\Carbon::parse($this->created_at)->format('jS M, Y');
    }
}
