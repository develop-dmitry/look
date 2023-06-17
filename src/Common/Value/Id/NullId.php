<?php

declare(strict_types=1);

namespace Look\Common\Value\Id;

class NullId implements IdInterface
{
    public function getValue(): int
    {
        return 0;
    }

    public function isNull(): bool
    {
        return true;
    }
}
