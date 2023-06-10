<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Contract;

use DateTimeInterface;
use Iterator;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Exception\WeatherDoesNotExistsException;

interface WeatherContainer
{
    /**
     * @param Weather $weather
     * @return void
     */
    public function addWeather(Weather $weather): void;

    /**
     * @param DateTimeInterface $date
     * @param WeatherPeriod $period
     * @return Weather
     * @throws WeatherDoesNotExistsException
     */
    public function getWeather(DateTimeInterface $date, WeatherPeriod $period): Weather;

    /**
     * @param DateTimeInterface $date
     * @return Weather[]
     */
    public function getWeatherForDate(DateTimeInterface $date): array;

    /**
     * @param DateTimeInterface $date
     * @return bool
     */
    public function hasWeatherForDate(DateTimeInterface $date): bool;
}
