<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Contract;

use DateTimeInterface;
use Look\Common\Value\Temperature\TemperatureInterface;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;

interface WeatherInterface
{
    /**
     * @return TemperatureInterface
     */
    public function getMinTemperature(): TemperatureInterface;

    /**
     * @return TemperatureInterface
     */
    public function getMaxTemperature(): TemperatureInterface;

    /**
     * @return TemperatureInterface
     */
    public function getAverageTemperature(): TemperatureInterface;

    /**
     * @return WeatherPeriod
     */
    public function getPeriod(): WeatherPeriod;

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface;
}
