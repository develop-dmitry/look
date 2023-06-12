<?php

declare(strict_types=1);

namespace Look\Common\Value\Id;

use Look\Common\Value\Id\Contract\Id as IdContract;

class NullId implements IdContract
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
