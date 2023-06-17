<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Application;

use DateTime;
use DateTimeInterface;
use Look\Common\Value\Temperature\Temperature;
use Look\LookSelection\Application\NearestWeather\DTO\NearestWeatherRequest;
use Look\LookSelection\Application\NearestWeather\NearestWeatherUseCase;
use Look\LookSelection\Domain\Weather\WeatherForecast;
use Look\LookSelection\Domain\Weather\Contract\WeatherGatewayInterface;
use Look\LookSelection\Domain\Weather\Weather;
use Look\LookSelection\Domain\Weather\WeatherPeriod;
use Tests\TestCase;

class NearestWeatherTest extends TestCase
{
    protected WeatherForecast $weatherForecast;

    protected DateTimeInterface $date;

    protected function setUp(): void
    {
        parent::setUp();

        $this->date = new DateTime();
        $this->weatherForecast = new WeatherForecast();

        $this->weatherForecast->addWeather(
            new Weather(
                new Temperature(-5),
                new Temperature(10),
                new Temperature(8),
                WeatherPeriod::Evening,
                $this->date
            ),
            $this->date,
            WeatherPeriod::Evening
        );

        $this->weatherForecast->addWeather(
            new Weather(
                new Temperature(-9),
                new Temperature(15),
                new Temperature(7),
                WeatherPeriod::Day,
                $this->date
            ),
            $this->date,
            WeatherPeriod::Day
        );
    }

    public function testNearestWeatherExecute(): void
    {
        $weatherGateway = $this->getMockBuilder(WeatherGatewayInterface::class)->getMock();
        $weatherGateway
            ->method('getWeather')
            ->willReturn($this->weatherForecast);
        $nearestWeatherUseCase = new NearestWeatherUseCase($weatherGateway);

        $nearestResponse = $nearestWeatherUseCase->execute(new NearestWeatherRequest(54, 37));
        $nearestWeather = $this->weatherForecast->forDayPeriod($this->date, WeatherPeriod::Day);

        $this->assertEquals($nearestWeather->getMinTemperature()->getValue(), $nearestResponse->getMinTemperature());
        $this->assertEquals($nearestWeather->getMaxTemperature()->getValue(), $nearestResponse->getMaxTemperature());
        $this->assertEquals($nearestWeather->getAverageTemperature()->getValue(), $nearestResponse->getAverageTemperature());
    }
}
