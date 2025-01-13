<?php

namespace App\Providers;


use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\TeacherRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
