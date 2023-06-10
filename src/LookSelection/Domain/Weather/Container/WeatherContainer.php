<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Container;

use DateTimeInterface;
use Look\LookSelection\Domain\Weather\Contract\Weather;
use Look\LookSelection\Domain\Weather\Contract\WeatherContainer as WeatherContainerContract;
use Look\LookSelection\Domain\Weather\Exception\WeatherDoesNotExistsException;

class WeatherContainer implements WeatherContainerContract
{
    protected string $dateFormat = 'Y-m-d';

    protected array $items = [];

    public function addWeather(Weather $weather): void
    {
        $formattedDate = $this->formattedDate($weather->getDate());
        $period = $weather->getPeriod()->value;

        $this->items[$formattedDate][$period] = $weather;

        $this->sortDate($weather->getDate());
    }

    public function getWeatherForDate(DateTimeInterface $date): array
    {
        return $this->items[$this->formattedDate($date)] ?? [];
    }

    public function getWeather(DateTimeInterface $date, WeatherPeriod $period): Weather
    {
        if (!$this->hasWeatherForDate($date)) {
            throw new WeatherDoesNotExistsException();
        }

        $weathers = $this->getWeatherForDate($date);

        if (!isset($weathers[$period->value])) {
            throw new WeatherDoesNotExistsException();
        }

        return $weathers[$period->value];
    }

    public function hasWeatherForDate(DateTimeInterface $date): bool
    {
        return count($this->getWeatherForDate($date)) > 0;
    }

    protected function sortDate(DateTimeInterface $date): void
    {
        if (!$this->hasWeatherForDate($date)) {
            return;
        }

        $formattedDate = $this->formattedDate($date);

        uksort(
            $this->items[$formattedDate],
            static function ($a, $b) {
                $periodA = WeatherPeriod::tryFrom($a);
                $periodB = WeatherPeriod::tryFrom($b);

                if ($periodA?->getSort() === $periodB?->getSort()) {
                    return 0;
                }

                return ($periodA?->getSort() > $periodB?->getSort()) ? 1 : -1;
            }
        );
    }

    protected function formattedDate(DateTimeInterface $date): string
    {
        return $date->format($this->dateFormat);
    }
}
