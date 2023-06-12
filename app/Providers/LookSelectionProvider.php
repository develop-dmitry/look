<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Look\LookSelection\Domain\Style\Contract\StyleRepository;
use Look\LookSelection\Infrastructure\Gateway\YandexWeatherGateway;
use Look\LookSelection\Infrastructure\Repository\EloquentStyleRepository;

class LookSelectionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->when(YandexWeatherGateway::class)
            ->needs('$token')
            ->give(config('weather.yandex_token'));

        $this->app->bind(StyleRepository::class, EloquentStyleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
