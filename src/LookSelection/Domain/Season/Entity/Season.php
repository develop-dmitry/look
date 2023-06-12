<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Season\Entity;

use Look\LookSelection\Domain\Season\Contract\Season as StyleContract;
use Look\LookSelection\Domain\Season\Value\Name;
use Look\LookSelection\Domain\Season\Value\Slug;

class Season implements StyleContract
{
    public function __construct(
        protected Name $name,
        protected Slug $slug
    ) {
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }
}
