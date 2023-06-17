<?php

declare(strict_types=1);

namespace Look\Common\Value\Name;

use Look\Common\Exception\InvalidValueException;

class Name implements NameInterface
{
    protected string $value;

    /**
     * @throws InvalidValueException
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidValueException
     */
    protected function validate(string $value): void
    {
        if ($value === '') {
            throw new InvalidValueException('Name can`t be empty');
        }

        if (mb_strlen($value) > 25) {
            throw new InvalidValueException('Name length must be less 25 symbols');
        }
    }
}
