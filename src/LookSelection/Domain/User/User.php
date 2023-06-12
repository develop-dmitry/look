<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\User;

use Look\Common\Value\Id\Contract\Id;
use Look\LookSelection\Domain\User\Contract\User as UserContract;

class User implements UserContract
{
    public function __construct(
        protected Id $id,
        protected array $styles
    ) {
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getStyles(): array
    {
        return $this->styles;
    }
}
