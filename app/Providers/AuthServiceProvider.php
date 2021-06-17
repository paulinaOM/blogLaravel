<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //Team::class => TeamPolicy::class,
        Post::class => PostPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-post',function ($user,$post){
            return $user->id==$post->user_id; //podra actualizar el post si e post le pertenece al usuario
        });

        Gate::define('delete-post',function ($user,$post){
            return $user->id==$post->user_id; //podra actualizar el post si e post le pertenece al usuario
        });

        //
    }
}
