<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Infrastructure;

use DateTime;
use Look\LookSelection\Infrastructure\Gateway\YandexWeatherGateway;
use Tests\TestCase;

class YandexWeatherGatewayTest extends TestCase
{
    protected float $lat = 54;

    protected float $lon = 37;

    /**
     * @group skip
     */
    public function testYandexWeatherWorking(): void
    {
        $weatherGateway = $this->app->make(YandexWeatherGateway::class);

        $this->expectNotToPerformAssertions();
        $weatherGateway->getWeather($this->lat, $this->lon);
    }

    /**
     * @group skip
     */
    public function testYandexWeatherThatReturnNotEmptyResponse(): void
    {
        $weatherGateway = $this->app->make(YandexWeatherGateway::class);
        $weatherContainer = $weatherGateway->getWeather($this->lat, $this->lon);

        $this->assertNotEmpty($weatherContainer->getWeatherForDate(new DateTime()));
    }
}
