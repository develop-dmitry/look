<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Look\LookSelection\Domain\Clothes\Contract\ClothesRepositoryInterface;
use Look\LookSelection\Domain\Event\Contract\EventRepositoryInterface;
use Look\LookSelection\Domain\Look\Contract\SuitableCalculatorStrategyInterface as SuitableCalculatorStrategyContract;
use Look\LookSelection\Domain\Look\Strategy\SuitableCalculatorStrategy;
use Look\LookSelection\Domain\Style\Contract\StyleRepositoryInterface;
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

        $this->app->bind(StyleRepositoryInterface::class, EloquentStyleRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EloquentEventRepository::class);
        $this->app->bind(ClothesRepositoryInterface::class, EloquentClothesRepository::class);
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
