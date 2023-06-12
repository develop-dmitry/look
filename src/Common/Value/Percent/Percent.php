<?php

declare(strict_types=1);

namespace Look\Common\Value\Percent;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Percent\Contact\Percent as PercentContract;

class Percent implements PercentContract
{
    protected float $value;

    /**
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
    protected function validate($value): void
    {
        if ($value < 0) {
            throw new InvalidValueException('Percent value must be more or equal zero');
        }

        if ($value > 100) {
            throw new InvalidValueException('Percent value must be less or equal one hundred');
        }
    }
}
