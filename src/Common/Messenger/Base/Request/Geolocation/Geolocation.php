<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Request\Geolocation;

class Geolocation implements GeolocationInterface
{
    public function __construct(
        protected float $lat,
        protected float $lon
    ) {
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }
}
