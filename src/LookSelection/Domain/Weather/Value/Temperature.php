<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Weather\Value;

use Look\Common\Exception\InvalidValueException;

class Temperature
{
    protected float $value;

    /**
     * @param float $value
     * @throws InvalidValueException
     */
    public function __construct(float $value)
    {
        $this->setValue($value);
    }


    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @throws InvalidValueException
     */
    public function setValue(float $value): void
    {
        $this->validate($value);
        $this->value = $value;
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
