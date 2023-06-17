<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Contract;

use DateTimeInterface;
use Look\LookSelection\Domain\Weather\Exception\WeatherDoesNotExistsException;
use Look\LookSelection\Domain\Weather\WeatherPeriod;

interface WeatherForecastInterface
{
    /**
     * @param DateTimeInterface $date
     * @return WeatherInterface[]
     */
    public function forDay(DateTimeInterface $date): array;

    /**
     * @param DateTimeInterface $date
     * @param WeatherPeriod $period
     * @return WeatherInterface
     * @throws WeatherDoesNotExistsException
     */
    public function forDayPeriod(DateTimeInterface $date, WeatherPeriod $period): WeatherInterface;

    /**
     * @param DateTimeInterface $date
     * @param WeatherPeriod $period
     * @return bool
     */
    public function hasForDayPeriod(DateTimeInterface $date, WeatherPeriod $period): bool;
}
