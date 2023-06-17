<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Look\Auth\Domain\User\Contract\UserRepositoryInterface;
use Look\Auth\Infrastructure\Repository\EloquentUserRepository;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
