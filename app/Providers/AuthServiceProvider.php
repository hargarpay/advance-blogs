<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        $this->registerPostPolicies();

        $this->registerUserPolicies();

        
    }

    public function registerPostPolicies(){
        Gate::define('view-post', function($user){
            return $user->hasAccess(['view-post']);
        });
        Gate::define('update-post', function($user, \App\Post $post){
            return $user->hasAccess(['update-post']) or $user->id === $post->user_id;
        });
        Gate::define('create-post', function($user){
            return $user->hasAccess(['create-post']);
        });
        Gate::define('draft-post', function($user){
            return $user->inRole(['editor']);
        });
        Gate::define('delete-post', function($user){
            return $user->hasAccess(['delete-post']);
        });

    }

    public function registerUserPolicies(){
        Gate::define('view-user', function($user){
            return $user->hasAccess(['view-user']);
        });
        Gate::define('update-user', function($user){
            return $user->hasAccess(['update-user']);
        });
        Gate::define('create-user', function($user){
            return $user->hasAccess(['create-user']);
        });
        Gate::define('delete-user', function($user){
            return $user->hasAccess(['delete-user']);
        });
    }
}
