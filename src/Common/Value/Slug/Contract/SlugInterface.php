<?php

declare(strict_types=1);

namespace Look\Common\Value\Slug\Contract;

use Look\Common\Exception\InvalidValueException;

interface SlugInterface
{
    /**
     * @return string
     */
    public function getValue(): string;
}
