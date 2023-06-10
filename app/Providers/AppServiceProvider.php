<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Look\LookSelection\Infrastructure\Gateway\YandexWeatherGateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
            ->when(YandexWeatherGateway::class)
            ->needs('$token')
            ->give(config('weather.yandex_token'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
