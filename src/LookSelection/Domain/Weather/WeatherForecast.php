<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather;

use DateTimeInterface;
use Look\LookSelection\Domain\Weather\Contract\WeatherForecastInterface;
use Look\LookSelection\Domain\Weather\Contract\WeatherInterface;
use Look\LookSelection\Domain\Weather\Exception\WeatherDoesNotExistsException;

class WeatherForecast implements WeatherForecastInterface
{
    protected string $dateFormat = 'Y-m-d';

    protected array $items = [];

    public function addWeather(WeatherInterface $weather, DateTimeInterface $date, WeatherPeriod $period): self
    {
        $this->items[$date->format($this->dateFormat)][$period->value] = $weather;
        $this->sortDate($date);
        return $this;
    }

    public function forDay(DateTimeInterface $date): array
    {
        return $this->items[$date->format($this->dateFormat)] ?? [];
    }

    public function forDayPeriod(DateTimeInterface $date, WeatherPeriod $period): WeatherInterface
    {
        if (!$this->hasForDayPeriod($date, $period)) {
            throw new WeatherDoesNotExistsException();
        }

        return $this->items[$date->format($this->dateFormat)][$period->value];
    }

    public function hasForDayPeriod(DateTimeInterface $date, WeatherPeriod $period): bool
    {
        return isset($this->items[$date->format($this->dateFormat)][$period->value]);
    }

    protected function sortDate(DateTimeInterface $date): void
    {
        $formatDate = $date->format($this->dateFormat);

        if (!isset($this->items[$formatDate])) {
            return;
        }

        uksort(
            $this->items[$formatDate],
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
}
