<?php

declare(strict_types=1);

namespace Look\Common\Value\Temperature;

use Look\Common\Exception\InvalidValueException;

class Temperature implements TemperatureInterface
{
    protected float $value;

    /**
     * @param float $value
     * @throws InvalidValueException
     */
    public function __construct(float $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @throws InvalidValueException
     */
    protected function validate(float $value): void
    {
        if ($value <= -50) {
            throw new InvalidValueException('Temperature should be more than -50');
        }

        if ($value >= 50) {
            throw new InvalidValueException('Temperature should not be more than +50');
        }
    }
}
