<?php

declare(strict_types=1);

namespace Look\LookSelection\Infrastructure\Gateway;

use DateTime;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Look\Common\Exception\InvalidValueException;
use Look\LookSelection\Domain\Weather\Container\WeatherContainer;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Contract\WeatherGatewayInterface;
use Look\LookSelection\Domain\Weather\Exception\FailedGetWeatherException;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Look\LookSelection\Domain\Weather\Weather;
use Psr\Log\LoggerInterface;

class YandexWeatherGateway implements WeatherGatewayInterface
{
    protected string $url = 'https://api.weather.yandex.ru/v2/informers';

    public function __construct(
        protected string $token,
        protected LoggerInterface $logger
    ) {
    }

    public function getWeather(float $lat, float $lon): WeatherContainer
    {
        $response = $this->executeRequest([
            'lat' => $lat,
            'lon' => $lon
        ]);

        if ($response->status() !== 200) {
            throw new FailedGetWeatherException($response->body());
        }

        $data = $response->json();

        return $this->makeWeatherContainer($data);
    }

    protected function makeWeatherContainer(array $data): WeatherContainer
    {
        $container = new WeatherContainer();

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

                $container->addWeather(new Weather(
                    new Temperature($part['temp_min']),
                    new Temperature($part['temp_max']),
                    new Temperature($part['temp_avg']),
                    $period,
                    $date
                ));
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
