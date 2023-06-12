<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Event\Entity;

use Look\LookSelection\Domain\Event\Contract\Event as EventContract;
use Look\LookSelection\Domain\Event\Value\Name;
use Look\LookSelection\Domain\Event\Value\Slug;

class Event implements EventContract
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
