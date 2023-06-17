<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\User;

use Look\Common\Value\Id\Contract\Id;
use Look\LookSelection\Domain\User\Contract\UserInterface;

class User implements UserInterface
{
    public function __construct(
        protected Id $id,
        protected array $styles,
        protected array $clothes
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

    public function getClothes(): array
    {
        return $this->clothes;
    }
}
