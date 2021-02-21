<?php

namespace App\Providers;

use App\Contracts\FilterContract;
use App\Contracts\RouterRepositoryContract;
use App\Http\Controllers\AuthController;
use App\Http\Filters\RouterFilter;
use App\Models\Router;
use App\Models\User;
use App\Repositories\AuthRepository;
use App\Services\AuthService;
use App\Services\AuthServiceImpl;
use App\Services\RouterService;
use App\Services\RouterServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RouterRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RouterService::class, function() {
            return new RouterServiceImpl(new RouterRepository(new Router()));
        });

        $this->app->singleton(AuthService::class, function() {
            return new AuthServiceImpl(new AuthRepository(new User()));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
