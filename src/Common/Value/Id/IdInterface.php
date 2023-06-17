<?php

declare(strict_types=1);

namespace Look\Common\Value\Id;

interface IdInterface
{
    /**
     * @return int
     */
    public function getValue(): int;

    /**
     * @return bool
     */
    public function isNull(): bool;
}
