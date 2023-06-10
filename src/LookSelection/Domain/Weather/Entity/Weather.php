<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Entity;

use DateTimeInterface;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Contract\Weather as WeatherContract;
use Look\LookSelection\Domain\Weather\Value\Temperature;

class Weather implements WeatherContract
{
    public function __construct(
        protected Temperature $minTemperature,
        protected Temperature $maxTemperature,
        protected Temperature $averageTemperature,
        protected WeatherPeriod $period,
        protected DateTimeInterface $date
    ) {
    }

    public function getMinTemperature(): Temperature
    {
        return $this->minTemperature;
    }

    public function getMaxTemperature(): Temperature
    {
        return $this->maxTemperature;
    }

    public function getAverageTemperature(): Temperature
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
