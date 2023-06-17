<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Contract;

use Look\LookSelection\Domain\Weather\Exception\FailedGetWeatherException;

interface WeatherGatewayInterface
{
    /**
     * @param float $lat
     * @param float $lon
     * @return WeatherForecastInterface
     * @throws FailedGetWeatherException
     */
    public function getWeather(float $lat, float $lon): WeatherForecastInterface;
}
