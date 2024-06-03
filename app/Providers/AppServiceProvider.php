<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\AuthServiceInterface;
use App\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    public function boot()
    {
        //
    }
}