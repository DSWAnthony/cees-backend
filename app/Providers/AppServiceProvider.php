<?php

namespace App\Providers;

use App\Repositories\Impl\ClassAttendaceRepositoryImpl;
use App\Repositories\Impl\CourseRepositoryImpl;
use App\Repositories\Impl\EventRepositoryImpl;
use App\Repositories\Impl\ForumReplyRepositoryImpl;
use App\Repositories\Impl\ForumRepositoryImpl;
use App\Repositories\Impl\ForumTopicRepositoryImpl;
use App\Repositories\Impl\LiveClassRepositoryImpl;
use App\Repositories\Impl\ModuleRepositoryImpl;
use App\Repositories\Impl\OptionRepositoryImpl;
use App\Repositories\Impl\QuestionRepositoryImpl;
use App\Repositories\Impl\QuizRepositoryImpl;
use App\Repositories\Impl\RegistrationRepositoryImpl;
use App\Repositories\Impl\TaskRepositoryImpl;
use App\Repositories\Impl\TaskSubmissionRepositoryImpl;
use App\Repositories\Impl\UserRepositoryImpl;
use App\Repositories\Interfaces\ClassAttendaceRepository;
use App\Repositories\Interfaces\CourseRepository;
use App\Repositories\Interfaces\EventRepository;
use App\Repositories\Interfaces\ForumReplyRepository;
use App\Repositories\Interfaces\ForumRepository;
use App\Repositories\Interfaces\ForumTopicRepository;
use App\Repositories\Interfaces\LiveClassRepository;
use App\Repositories\Interfaces\ModuleRepository;
use App\Repositories\Interfaces\OptionRepository;
use App\Repositories\Interfaces\QuestionRepository;
use App\Repositories\Interfaces\QuizRepository;
use App\Repositories\Interfaces\RegistrationRepository;
use App\Repositories\Interfaces\TaskRepository;
use App\Repositories\Interfaces\TaskSubmissionRepository;
use App\Repositories\Interfaces\UserRespository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(UserRespository::class, UserRepositoryImpl::class);
        $this->app->bind(CourseRepository::class,CourseRepositoryImpl::class);
        $this->app->bind(ModuleRepository::class,ModuleRepositoryImpl::class);
        $this->app->bind(RegistrationRepository::class,RegistrationRepositoryImpl::class);
        $this->app->bind(TaskRepository::class,TaskRepositoryImpl::class);
        $this->app->bind(LiveClassRepository::class,LiveClassRepositoryImpl::class);
        $this->app->bind(EventRepository::class,EventRepositoryImpl::class);
        $this->app->bind(ForumRepository::class,ForumRepositoryImpl::class);
        $this->app->bind(ForumTopicRepository::class,ForumTopicRepositoryImpl::class);
        $this->app->bind(ForumReplyRepository::class,ForumReplyRepositoryImpl::class);
        $this->app->bind(TaskSubmissionRepository::class,TaskSubmissionRepositoryImpl::class);
        $this->app->bind(ClassAttendaceRepository::class,ClassAttendaceRepositoryImpl::class);
    }

    public function boot(): void
    {
    
    }
}
