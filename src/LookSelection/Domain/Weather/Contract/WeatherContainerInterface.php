<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Contract;

use DateTimeInterface;
use Iterator;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Exception\WeatherDoesNotExistsException;

interface WeatherContainerInterface
{
    /**
     * @param WeatherInterface $weather
     * @return void
     */
    public function addWeather(WeatherInterface $weather): void;

    /**
     * @param DateTimeInterface $date
     * @param WeatherPeriod $period
     * @return WeatherInterface
     * @throws WeatherDoesNotExistsException
     */
    public function getWeather(DateTimeInterface $date, WeatherPeriod $period): WeatherInterface;

    /**
     * @param DateTimeInterface $date
     * @return WeatherInterface[]
     */
    public function getWeatherForDate(DateTimeInterface $date): array;

    /**
     * @param DateTimeInterface $date
     * @return bool
     */
    public function hasWeatherForDate(DateTimeInterface $date): bool;
}
