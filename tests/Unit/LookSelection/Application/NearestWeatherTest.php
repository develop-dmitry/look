<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Application;

use DateTime;
use DateTimeInterface;
use Look\LookSelection\Application\NearestWeather\DTO\NearestWeatherRequest;
use Look\LookSelection\Application\NearestWeather\NearestWeatherUseCase;
use Look\LookSelection\Domain\Weather\Container\WeatherContainer;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Contract\WeatherGatewayInterface;
use Look\LookSelection\Domain\Weather\Entity\Weather;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Tests\TestCase;

class NearestWeatherTest extends TestCase
{
    protected WeatherContainer $weatherContainer;

    protected DateTimeInterface $date;

    protected function setUp(): void
    {
        parent::setUp();

        $this->date = new DateTime();
        $this->weatherContainer = new WeatherContainer();

        $this->weatherContainer->addWeather(new Weather(
            new Temperature(-5),
            new Temperature(10),
            new Temperature(8),
            WeatherPeriod::Evening,
            $this->date
        ));

        $this->weatherContainer->addWeather(new Weather(
            new Temperature(-9),
            new Temperature(15),
            new Temperature(7),
            WeatherPeriod::Day,
            $this->date
        ));
    }

    public function testNearestWeatherExecute(): void
    {
        $weatherGateway = $this->getMockBuilder(WeatherGatewayInterface::class)->getMock();
        $weatherGateway
            ->method('getWeather')
            ->willReturn($this->weatherContainer);
        $nearestWeatherUseCase = new NearestWeatherUseCase($weatherGateway);

        $nearestResponse = $nearestWeatherUseCase->execute(new NearestWeatherRequest(54, 37));
        $nearestWeather = $this->weatherContainer->getWeather($this->date, WeatherPeriod::Day);

        $this->assertEquals($nearestWeather->getMinTemperature()->getValue(), $nearestResponse->getMinTemperature());
        $this->assertEquals($nearestWeather->getMaxTemperature()->getValue(), $nearestResponse->getMaxTemperature());
        $this->assertEquals($nearestWeather->getAverageTemperature()->getValue(), $nearestResponse->getAverageTemperature());
    }
}
