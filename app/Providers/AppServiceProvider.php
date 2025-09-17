<?php

namespace App\Providers;

use App\Models\Api\User;
use App\Observers\Api\UserObserver;
use App\Repositories\Api\Interfaces\UserRepositoryInterface;
use App\Repositories\Api\UserRepository;
use App\Services\Api\Auth\AuthServiceInterface;
use App\Services\Api\Auth\SanctumAuthService;
use App\Services\Api\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthServiceInterface::class,
            SanctumAuthService::class
        );
        
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
