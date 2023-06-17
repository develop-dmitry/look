<?php

declare(strict_types=1);

namespace Look\Common\Value\Temperature;

interface TemperatureInterface
{
    /**
     * @return float
     */
    public function getValue(): float;
}
