<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Look\Common\Dictionary\DictionaryInterface;
use Look\Common\Dictionary\LaravelDictionary;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DictionaryInterface::class, LaravelDictionary::class);
        $this->app->when(LaravelDictionary::class)
            ->needs('$locale')
            ->give(config('app.locale'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
