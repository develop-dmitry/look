<?php

declare(strict_types=1);

namespace Look\Common\Value\Slug;

interface SlugInterface
{
    /**
     * @return string
     */
    public function getValue(): string;
}
