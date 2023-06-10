<?php

declare(strict_types=1);

namespace Look\LookSelection\Application\NearestWeather\Contract;

use Look\LookSelection\Application\NearestWeather\DTO\NearestWeatherRequest;
use Look\LookSelection\Application\NearestWeather\DTO\NearestWeatherResponse;
use Look\LookSelection\Domain\Weather\Exception\FailedGetWeatherException;

interface NearestWeather
{
    /**
     * @param NearestWeatherRequest $request
     * @return NearestWeatherResponse
     * @throws FailedGetWeatherException
     */
    public function execute(NearestWeatherRequest $request): NearestWeatherResponse;
}
