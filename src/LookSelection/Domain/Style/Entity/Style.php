<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Style\Entity;

use Look\LookSelection\Domain\Style\Contract\Style as StyleContract;
use Look\LookSelection\Domain\Style\Value\Name;
use Look\LookSelection\Domain\Style\Value\Slug;

class Style implements StyleContract
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
