<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
<<<<<<< Updated upstream
        //
=======
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(AuthRepositoryInterface::class,AuthRepository::class);
        
>>>>>>> Stashed changes
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
