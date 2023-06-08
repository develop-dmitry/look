<?php

declare(strict_types=1);

namespace Look\Login\Domain\User\Value;

use Look\Common\Exception\InvalidValueException;

class TelegramToken
{
    protected int $value;

    /**
     * @param int $value
     * @throws InvalidValueException
     */
    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @throws InvalidValueException
     */
    public function setValue(int $value): void
    {
        $this->validate($value);
        $this->value = $value;
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
