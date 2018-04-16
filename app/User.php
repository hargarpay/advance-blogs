<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * The attributes that should be mutated to dates
    *
    **/
        protected $dates = ['deleted_at'];
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function roles(){
        return $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id')->withTimestamps();;
    }

    public function hasAccess($permissions)
    {
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    

    public function inRole($roles){
        foreach ($this->roles as $role) {
            return in_array($role->slug, $roles);
        }
    }

    public function getCreatedAtFormatAttribute($value){
        return \Carbon\Carbon::parse($this->created_at)->format('jS F, Y');
    }
}
