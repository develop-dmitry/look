<?php

declare(strict_types=1);

namespace Look\Common\Value\Slug;

use Look\Common\Exception\InvalidValueException;

class Slug implements SlugInterface
{
    protected int $maxLength = 100;

    protected string $value;

    /**
     * @throws InvalidValueException
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidValueException
     */
    protected function validate($value): void
    {
        if (!preg_match('/^[A-z\-]+$/', $value)) {
            throw new InvalidValueException('Slug should be contain only latin symbol');
        }

        if (strlen($value) > $this->maxLength) {
            throw new InvalidValueException("Slug should be less $this->maxLength symbols");
        }
    }
}
