<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Request\Geolocation;

interface GeolocationInterface
{
    /**
     * @return float
     */
    public function getLat(): float;

    /**
     * @return float
     * @return float
     */
    public function getLon(): float;
}
