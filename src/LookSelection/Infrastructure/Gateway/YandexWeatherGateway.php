<?php

declare(strict_types=1);

namespace Look\LookSelection\Infrastructure\Gateway;

use DateTime;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Temperature\Temperature;
use Look\LookSelection\Domain\Weather\Contract\WeatherGatewayInterface;
use Look\LookSelection\Domain\Weather\Exception\FailedGetWeatherException;
use Look\LookSelection\Domain\Weather\Weather;
use Look\LookSelection\Domain\Weather\WeatherForecast;
use Look\LookSelection\Domain\Weather\WeatherPeriod;
use Psr\Log\LoggerInterface;

class YandexWeatherGateway implements WeatherGatewayInterface
{
    protected string $url = 'https://api.weather.yandex.ru/v2/informers';

    public function __construct(
        protected string $token,
        protected LoggerInterface $logger
    ) {
    }

    public function getWeather(float $lat, float $lon): WeatherForecast
    {
        $response = $this->executeRequest([
            'lat' => $lat,
            'lon' => $lon
        ]);

        if ($response->status() !== 200) {
            throw new FailedGetWeatherException($response->body());
        }

        $data = $response->json();

        return $this->makeWeatherForecast($data);
    }

    protected function makeWeatherForecast(array $data): WeatherForecast
    {
        $container = new WeatherForecast();

        foreach ($data['forecast']['parts'] as $part) {
            try {
                $date = DateTime::createFromFormat('Y-m-d', $data['forecast']['date']);

                if (!$date) {
                    throw new InvalidValueException('Invalid date');
                }

                $period = WeatherPeriod::tryFrom($part['part_name']);

                if (!$period) {
                    throw new InvalidValueException('Invalid period name');
                }

                $container->addWeather(
                    new Weather(
                        new Temperature($part['temp_min']),
                        new Temperature($part['temp_max']),
                        new Temperature($part['temp_avg'])
                    ),
                    $date,
                    $period
                );
            } catch (InvalidValueException $exception) {
                $this->logger->debug('Failed to make weather object', [
                    'data' => $part,
                    'exception' => $exception->getMessage()
                ]);
            }
        }

        return $container;
    }

    protected function executeRequest(array $params): PromiseInterface|Response
    {
        $params = $this->prepareParams($params);
        $headers = ['X-Yandex-API-Key' => $this->token];

        return Http::withHeaders($headers)->get($this->url, $params);
    }

    protected function prepareParams(array $params): array
    {
        if (!isset($params['lang'])) {
            $params['lang'] = 'ru_RU';
        }

        return $params;
    }
}
