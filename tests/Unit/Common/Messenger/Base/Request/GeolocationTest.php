<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Request;

use Look\Common\Messenger\Base\Request\Geolocation\Geolocation;
use Tests\TestCase;

class GeolocationTest extends TestCase
{
    public function testGeolocationShouldReturnLat(): void
    {
        $geolocation = new Geolocation(57, 53);

        $this->assertEquals(57, $geolocation->getLat());
    }

    public function testGeolocationShouldReturnLon(): void
    {
        $geolocation = new Geolocation(57, 53);

        $this->assertEquals(53, $geolocation->getLon());
    }
}
