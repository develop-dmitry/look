<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Style;

use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Slug\Contract\Slug;
use Look\LookSelection\Domain\Style\Contract\Style as StyleContract;

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
