<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\CommentRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\StatusRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TaskRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(AuthRepositoryInterface::class,AuthRepository::class);
        $this->app->bind(TaskRepositoryInterface::class,TaskRepository::class);
        $this->app->bind(StatusRepositoryInterface::class,StatusRepository::class);
        $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

