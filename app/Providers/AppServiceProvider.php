<?php

namespace App\Providers;

use App\Repositories\Settings\User\EloquentUsersRepository;
use App\Repositories\Settings\User\UsersRepository;
use App\Repositories\Tokens\UserTokens\EloquentUsersTokensRepository;
use App\Repositories\Tokens\UserTokens\UsersTokensRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsersRepository::class, EloquentUsersRepository::class);
        $this->app->bind(UsersTokensRepository::class, EloquentUsersTokensRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
