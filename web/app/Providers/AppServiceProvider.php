<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Post\PostRepositoryInterface::class,
            \App\Repositories\Post\PostEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryEloquentRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Admin\AdminInterface::class,
            \App\Repositories\Admin\AdminRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Role\RoleRepositoryInterface::class,
            \App\Repositories\Role\RoleEloquentRepository::class            
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
