<?php

namespace App\Providers;

use App\Repositories\Impl\OptionRepositoryImpl;
use App\Repositories\Impl\QuestionRepositoryImpl;
use App\Repositories\Impl\QuizRepositoryImpl;
use App\Repositories\Impl\UserRepositoryImpl;
use App\Repositories\Interfaces\OptionRepository;
use App\Repositories\Interfaces\QuestionRepository;
use App\Repositories\Interfaces\QuizRepository;
use App\Repositories\Interfaces\UserRespository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRespository::class, UserRepositoryImpl::class);
        $this->app->bind(QuizRepository::class, QuizRepositoryImpl::class);
        $this->app->bind(QuestionRepository::class, QuestionRepositoryImpl::class);
        $this->app->bind(OptionRepository::class, OptionRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
