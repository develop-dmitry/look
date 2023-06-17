<?php

declare(strict_types=1);

namespace Look\Common\Value\Name\Contract;

interface NameInterface
{
    /**
     * @return string
     */
    public function getValue(): string;
}
