<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Contract;

use Look\Common\Value\Temperature\TemperatureInterface;

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
}
