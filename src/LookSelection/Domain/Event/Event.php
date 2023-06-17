<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Event;

use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Slug\Contract\Slug;
use Look\LookSelection\Domain\Event\Contract\Event as EventContract;

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
