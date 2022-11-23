<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function($user){
            // return $user->role_id == User::ADMIN_ROLE_ID ?
            //     Response::allow() |
            //     Response::deny('You must be an administrator to access this page');

                if($user->role_id == User::ADMIN_ROLE_ID){
                    return Response::allow();
                }else{
                           Response::deny('You must be an administrator to access this page');
                }
        });
    }
}
