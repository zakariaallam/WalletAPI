<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObservers;
use App\Repository\Interfaces\UserRepoInterface;
use App\Repository\UserRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
            $this->app->bind(UserRepoInterface::class,UserRepo::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObservers::class);
    }
}
