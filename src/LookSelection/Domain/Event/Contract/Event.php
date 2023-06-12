<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Event\Contract;

use Look\LookSelection\Domain\Event\Value\Name;
use Look\LookSelection\Domain\Event\Value\Slug;

interface Event
{
    /**
     * @return Name
     */
    public function getName(): Name;

    /**
     * @return Slug
     */
    public function getSlug(): Slug;
}
