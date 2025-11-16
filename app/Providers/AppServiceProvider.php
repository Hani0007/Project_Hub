<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\ProjectRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(AuthRepositoryInterface::class,AuthRepository::class);
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

