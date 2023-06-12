<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Season\Value;

use Look\Common\Exception\InvalidValueException;

class Name
{
    protected string $value;

    /**
     * @param string $value
     * @throws InvalidValueException
     */
    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @throws InvalidValueException
     */
    public function setValue(string $value): void
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return void
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
