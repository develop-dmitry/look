<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Event;

use Look\Common\Value\Name\NameInterface;
use Look\Common\Value\Slug\SlugInterface;
use Look\LookSelection\Domain\Event\Contract\EventInterface;

class Event implements EventInterface
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
