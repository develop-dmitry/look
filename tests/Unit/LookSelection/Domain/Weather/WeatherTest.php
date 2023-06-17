<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Weather;

use DateTime;
use Look\Common\Value\Temperature\Temperature;
use Look\LookSelection\Domain\Weather\Weather;
use Look\LookSelection\Domain\Weather\WeatherPeriod;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    protected Temperature $minTemperature;

    protected Temperature $maxTemperature;

    protected Temperature $averageTemperature;

    protected WeatherPeriod $period;

    protected DateTime $date;

    protected function setUp(): void
    {
        parent::setUp();

        $this->minTemperature = new Temperature(-10);
        $this->maxTemperature = new Temperature(30);
        $this->averageTemperature = new Temperature(0);
        $this->period = WeatherPeriod::Day;
        $this->date = new DateTime();
    }

    public function testWeatherShouldReturnMinTemperature(): void
    {
        $weather = new Weather(
            $this->minTemperature,
            $this->maxTemperature,
            $this->averageTemperature,
            $this->period,
            $this->date
        );

        $this->assertEquals($this->minTemperature->getValue(), $weather->getMinTemperature()->getValue());
    }

    public function testWeatherShouldReturnMaxTemperature(): void
    {
        $weather = new Weather(
            $this->minTemperature,
            $this->maxTemperature,
            $this->averageTemperature,
            $this->period,
            $this->date
        );

        $this->assertEquals($this->maxTemperature->getValue(), $weather->getMaxTemperature()->getValue());
    }

    public function testWeatherReturnAverageTemperature(): void
    {
        $weather = new Weather(
            $this->minTemperature,
            $this->maxTemperature,
            $this->averageTemperature,
            $this->period,
            $this->date
        );

        $this->assertEquals($this->averageTemperature->getValue(), $weather->getAverageTemperature()->getValue());
    }

    public function testWeatherReturnPeriod(): void
    {
        $weather = new Weather(
            $this->minTemperature,
            $this->maxTemperature,
            $this->averageTemperature,
            $this->period,
            $this->date
        );

        $this->assertEquals($this->period->value, $weather->getPeriod()->value);
    }

    public function testWeatherReturnDate(): void
    {
        $weather = new Weather(
            $this->minTemperature,
            $this->maxTemperature,
            $this->averageTemperature,
            $this->period,
            $this->date
        );

        $this->assertEquals($this->date->getTimestamp(), $weather->getDate()->getTimestamp());
    }
}
