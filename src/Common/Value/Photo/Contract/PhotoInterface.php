<?php

declare(strict_types=1);

namespace Look\Common\Value\Photo\Contract;

interface PhotoInterface
{
    /**
     * @return string
     */
    public function getValue(): string;
}
