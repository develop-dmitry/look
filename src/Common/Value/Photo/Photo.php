<?php

declare(strict_types=1);

namespace Look\Common\Value\Photo;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Photo\Contract\PhotoInterface;

class Photo implements PhotoInterface
{
    protected string $stub = '';

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
        return $this->value ?: $this->stub;
    }

    /**
     * @throws InvalidValueException
     */
    protected function validate(string $value): void
    {
        if ($value === '') {
            return;
        }

        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidValueException('Invalid photo url');
        }
    }
}
