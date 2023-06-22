<?php

declare(strict_types=1);

namespace Look\Common\Value\MessengerToken;

use Look\Common\Exception\InvalidValueException;

abstract class AbstractMessengerToken implements MessengerTokenInterface
{
    protected string|int $value;

    /**
     * @param string|int $value
     * @throws InvalidValueException
     */
    public function __construct(string|int $value)
    {
        $this->setValue($value);
    }

    /**
     * @return string|int
     */
    public function getValue(): string|int
    {
        return $this->value;
    }

    /**
     * @param string|int $value
     * @throws InvalidValueException
     */
    public function setValue(string|int $value): void
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @throws InvalidValueException
     */
    abstract protected function validate(string|int $value): void;
}
