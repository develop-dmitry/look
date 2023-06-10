<?php

declare(strict_types=1);

namespace Look\LookSelection\Application\NearestWeather;

use DateTime;
use Look\LookSelection\Application\NearestWeather\Contract\NearestWeather;
use Look\LookSelection\Application\NearestWeather\DTO\NearestWeatherRequest;
use Look\LookSelection\Application\NearestWeather\DTO\NearestWeatherResponse;
use Look\LookSelection\Domain\Weather\Contract\WeatherGateway;
use Look\LookSelection\Domain\Weather\Exception\FailedGetWeatherException;

class NearestWeatherUseCase implements NearestWeather
{
    public function __construct(
        protected WeatherGateway $weatherGateway
    ) {
    }

    public function execute(NearestWeatherRequest $request): NearestWeatherResponse
    {
        $weatherContainer = $this->weatherGateway->getWeather($request->getLat(), $request->getLon());
        $currentDate = new DateTime();

        if (!$weatherContainer->hasWeatherForDate($currentDate)) {
            throw new FailedGetWeatherException();
        }

        $currentDateWeather = $weatherContainer->getWeatherForDate($currentDate);
        $currentWeather = current($currentDateWeather);

        return new NearestWeatherResponse(
            $currentWeather->getMinTemperature()->getValue(),
            $currentWeather->getMaxTemperature()->getValue(),
            $currentWeather->getAverageTemperature()->getValue(),
        );
    }
}
