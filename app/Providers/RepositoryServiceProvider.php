<?php

namespace App\Providers;

use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\StudentGraduatedRepository;
use App\Repository\StudentPromotionRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\TeacherRepositoryInterface;
use App\Repository\StudentGraduatedRepositoryInterface;
use App\Repository\StudentPromotionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(StudentPromotionRepositoryInterface::class, StudentPromotionRepository::class);
        $this->app->bind(StudentGraduatedRepositoryInterface::class, StudentGraduatedRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
