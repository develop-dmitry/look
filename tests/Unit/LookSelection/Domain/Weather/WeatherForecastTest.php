<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Weather;

use DateTime;
use DateTimeInterface;
use Look\Common\Value\Temperature\Temperature;
use Look\LookSelection\Domain\Weather\Exception\WeatherDoesNotExistsException;
use Look\LookSelection\Domain\Weather\Weather;
use Look\LookSelection\Domain\Weather\WeatherForecast;
use Look\LookSelection\Domain\Weather\WeatherPeriod;
use Tests\TestCase;

class WeatherForecastTest extends TestCase
{
    protected Weather $weather;

    protected Weather $secondWeather;

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

        $this->secondWeather = new Weather(
            new Temperature(-10),
            new Temperature(5),
            new Temperature(0),
            WeatherPeriod::Day,
            $this->date
        );
    }

    public function testWeatherForecastForDayWhenIsEmpty(): void
    {
        $weatherForecast = new WeatherForecast();

        $this->assertEmpty($weatherForecast->forDay($this->date));
    }

    public function testWeatherForecastForDayWhenIsNotEmpty(): void
    {
        $weatherForecast = new WeatherForecast();
        $weatherForecast->addWeather($this->weather, $this->date, WeatherPeriod::Morning);

        $this->assertNotEmpty($weatherForecast->forDay($this->date));
    }

    public function testWeatherForecastForDayPeriodWhenIsEmpty(): void
    {
        $weatherForecast = new WeatherForecast();

        $this->expectException(WeatherDoesNotExistsException::class);
        $weatherForecast->forDayPeriod($this->date, WeatherPeriod::Morning);
    }

    public function testWeatherForecastForDayPeriodWhenIsNotEmpty(): void
    {
        $weatherForecast = new WeatherForecast();
        $weatherForecast->addWeather($this->weather, $this->date, WeatherPeriod::Morning);

        $this->expectNotToPerformAssertions();
        $weatherForecast->forDayPeriod($this->date, WeatherPeriod::Morning);
    }

    public function testCorrectDataWeatherForecastForDayPeriod(): void
    {
        $weatherForecast = new WeatherForecast();
        $weatherForecast->addWeather($this->weather, $this->date, WeatherPeriod::Morning);

        $weather = $weatherForecast->forDayPeriod($this->date, WeatherPeriod::Morning);
        $this->assertEqualsWeather($this->weather, $weather);
    }

    public function testWeatherForecastForDaySorting(): void
    {
        $weatherForecast = new WeatherForecast();
        $weatherForecast->addWeather($this->weather, $this->date, WeatherPeriod::Evening);
        $weatherForecast->addWeather($this->secondWeather, $this->date, WeatherPeriod::Morning);

        $dayForecast = $weatherForecast->forDay($this->date);
        $periodKeys = array_keys($dayForecast);

        $this->assertCount(2, $periodKeys);
        $this->assertEquals(0, array_search(WeatherPeriod::Morning->value, $periodKeys));
        $this->assertEquals(1, array_search(WeatherPeriod::Evening->value, $periodKeys));
    }

    protected function assertEqualsWeather(Weather $expected, Weather $actual): void
    {
        $this->assertEquals($expected->getMinTemperature()->getValue(), $actual->getMinTemperature()->getValue());
        $this->assertEquals($expected->getMaxTemperature()->getValue(), $actual->getMaxTemperature()->getValue());
        $this->assertEquals(
            $expected->getAverageTemperature()->getValue(),
            $actual->getAverageTemperature()->getValue()
        );
    }
}
