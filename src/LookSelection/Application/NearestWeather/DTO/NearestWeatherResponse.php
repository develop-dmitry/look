<?php

declare(strict_types=1);

namespace Look\LookSelection\Application\NearestWeather\DTO;

class NearestWeatherResponse
{
    /**
     * @param float $minTemperature
     * @param float $maxTemperature
     * @param float $averageTemperature
     */
    public function __construct(
        protected float $minTemperature,
        protected float $maxTemperature,
        protected float $averageTemperature
    ) {
    }

    /**
     * @return float
     */
    public function getMinTemperature(): float
    {
        return $this->minTemperature;
    }

    /**
     * @return float
     */
    public function getMaxTemperature(): float
    {
        return $this->maxTemperature;
    }

    /**
     * @return float
     */
    public function getAverageTemperature(): float
    {
        return $this->averageTemperature;
    }
}
