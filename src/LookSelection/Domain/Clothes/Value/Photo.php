<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Value;

use Look\Common\Exception\InvalidValueException;

class Photo
{
    protected array $extensions = [
        'png',
        'jpg',
        'gif'
    ];

    protected string $stub = '/storage/stub.jpg';

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
        return $this->value ?: $this->stub;
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
    protected function validate(string $value): void
    {
        if ($value === '') {
            return;
        }

        $path = pathinfo($value);

        if (!isset($path['extension']) || !in_array($path['extension'], $this->extensions, true)) {
            throw new InvalidValueException('Invalid image extension');
        }
    }
}
