<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Contract;

use DateTimeInterface;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Value\Temperature;

interface WeatherInterface
{
    /**
     * @return Temperature
     */
    public function getMinTemperature(): Temperature;

    /**
     * @return Temperature
     */
    public function getMaxTemperature(): Temperature;

    /**
     * @return Temperature
     */
    public function getAverageTemperature(): Temperature;

    /**
     * @return WeatherPeriod
     */
    public function getPeriod(): WeatherPeriod;

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface;
}
