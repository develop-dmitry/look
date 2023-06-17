<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Look\LookSelection\Domain\Clothes\Contract\ClothesRepository;
use Look\LookSelection\Domain\Event\Contract\EventRepository;
use Look\LookSelection\Domain\Look\Contract\SuitableCalculatorStrategy as SuitableCalculatorStrategyContract;
use Look\LookSelection\Domain\Look\Strategy\SuitableCalculatorStrategy;
use Look\LookSelection\Domain\Style\Contract\StyleRepository;
use Look\LookSelection\Infrastructure\Gateway\YandexWeatherGateway;
use Look\LookSelection\Infrastructure\Repository\EloquentClothesRepository;
use Look\LookSelection\Infrastructure\Repository\EloquentEventRepository;
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
        $this->app->bind(EventRepository::class, EloquentEventRepository::class);
        $this->app->bind(ClothesRepository::class, EloquentClothesRepository::class);
        $this->app->bind(SuitableCalculatorStrategyContract::class, SuitableCalculatorStrategy::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
