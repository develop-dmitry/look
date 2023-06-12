<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Style\Value;

use Look\Common\Exception\InvalidValueException;

class Slug
{
    protected string $value;

    /**
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
     * @throws InvalidValueException
     */
    protected function validate($value): void
    {
        if (!preg_match('/^[A-z]+$/', $value)) {
            throw new InvalidValueException('Slug should be contain only latin symbol');
        }

        if (strlen($value) > 25) {
            throw new InvalidValueException('Slug should be less 25 symbols');
        }
    }
}
