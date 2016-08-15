<?php

namespace GymWeb\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //USERS
        $this->app->bind(
            'GymWeb\RepositoryInterface\UserRepositoryInterface',
            'GymWeb\Repository\UserRepository'
        );
    }
}
