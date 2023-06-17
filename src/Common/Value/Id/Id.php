<?php

declare(strict_types=1);

namespace Look\Common\Value\Id;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Id\Contract\IdInterface;

class Id implements IdInterface
{
    protected int $value;

    /**
     * @throws InvalidValueException
     */
    public function __construct(int $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function isNull(): bool
    {
        return false;
    }

    /**
     * @throws InvalidValueException
     */
    protected function validate(int $value): void
    {
        if ($value <= 0) {
            throw new InvalidValueException('Id should be more than zero');
        }
    }
}
