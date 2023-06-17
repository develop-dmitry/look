<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather;

use DateTimeInterface;
use Look\Common\Value\Temperature\TemperatureInterface;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Contract\WeatherInterface;

class Weather implements WeatherInterface
{
    public function __construct(
        protected TemperatureInterface $minTemperature,
        protected TemperatureInterface $maxTemperature,
        protected TemperatureInterface $averageTemperature,
        protected WeatherPeriod $period,
        protected DateTimeInterface $date
    ) {
    }

    public function getMinTemperature(): TemperatureInterface
    {
        return $this->minTemperature;
    }

    public function getMaxTemperature(): TemperatureInterface
    {
        return $this->maxTemperature;
    }

    public function getAverageTemperature(): TemperatureInterface
    {
        return $this->averageTemperature;
    }

    public function getPeriod(): WeatherPeriod
    {
        return $this->period;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }
}
