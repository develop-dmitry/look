<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Weather;

use DateTime;
use DateTimeInterface;
use Look\LookSelection\Domain\Weather\Container\WeatherContainer;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Entity\Weather;
use Look\LookSelection\Domain\Weather\Exception\WeatherDoesNotExistsException;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Tests\TestCase;

class WeatherContainerTest extends TestCase
{
    protected Weather $weather;

    protected DateTimeInterface $date;

    protected function setUp(): void
    {
        parent::setUp();

        $this->date = new DateTime();

        $this->weather = new Weather(
            new Temperature(-15),
            new Temperature(0),
            new Temperature(-10),
            WeatherPeriod::Day,
            $this->date
        );

    }

    public function testContainerAddWeather(): void
    {
        $container = new WeatherContainer();
        $container->addWeather($this->weather);

        $this->assertTrue($container->hasWeatherForDate($this->date));
    }

    public function testContainerThatReturnCorrectDate(): void
    {
        $container = new WeatherContainer();
        $container->addWeather($this->weather);

        $weather = $container->getWeather($this->date, WeatherPeriod::Day);

        $this->equalWeathers($this->weather, $weather);
    }

    public function testContainerWhenWeatherDoesNotExists(): void
    {
        $container = new WeatherContainer();
        $container->addWeather($this->weather);

        $this->expectException(WeatherDoesNotExistsException::class);
        $container->getWeather($this->date, WeatherPeriod::Evening);
    }

    public function testContainerThatReturnNotEmptyArrayForDate(): void
    {
        $container = new WeatherContainer();
        $container->addWeather($this->weather);

        $this->assertCount(1, $container->getWeatherForDate($this->date));
    }

    public function testContainerThatReturnCorrectWeatherForDate(): void
    {
        $container = new WeatherContainer();
        $container->addWeather($this->weather);

        $weathers = $container->getWeatherForDate($this->date);

        $this->equalWeathers($this->weather, $weathers[WeatherPeriod::Day->value]);
    }

    public function testContainerSorting(): void
    {
        $weatherContainer = new WeatherContainer();

        $weatherContainer->addWeather(new Weather(
            new Temperature(-5),
            new Temperature(10),
            new Temperature(8),
            WeatherPeriod::Evening,
            $this->date
        ));

        $weatherContainer->addWeather($this->weather);

        $weatherDate = $weatherContainer->getWeatherForDate($this->date);

        $this->equalWeathers($this->weather, current($weatherDate));
    }

    protected function equalWeathers(Weather $weather, Weather $compareWeather): void
    {
        $this->assertEquals($compareWeather->getMinTemperature()->getValue(), $weather->getMinTemperature()->getValue());
        $this->assertEquals($compareWeather->getMaxTemperature()->getValue(), $weather->getMaxTemperature()->getValue());
    }
}
