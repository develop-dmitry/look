<?php

declare(strict_types=1);

namespace Look\Common\Value\Name\Contract;

interface Name
{
    /**
     * @return string
     */
    public function getValue(): string;
}
