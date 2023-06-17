<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Style;

use Look\Common\Value\Name\NameInterface;
use Look\Common\Value\Slug\SlugInterface;
use Look\LookSelection\Domain\Style\Contract\StyleInterface;

class Style implements StyleInterface
{
    public function __construct(
        protected NameInterface $name,
        protected SlugInterface $slug
    ) {
    }

    public function getName(): NameInterface
    {
        return $this->name;
    }

    public function getSlug(): SlugInterface
    {
        return $this->slug;
    }
}
