<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather;

enum WeatherPeriod: string
{
    case Night = 'night';

    case Morning = 'morning';

    case Day = 'day';

    case Evening = 'evening';

    public function getSort(): int
    {
        return match ($this) {
            self::Night => 1,
            self::Morning => 2,
            self::Day => 3,
            self::Evening => 4
        };
    }
}
