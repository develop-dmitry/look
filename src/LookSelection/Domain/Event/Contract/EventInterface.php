<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Event\Contract;

use Look\Common\Value\Name\NameInterface;
use Look\Common\Value\Slug\SlugInterface;

interface EventInterface
{
    /**
     * @return NameInterface
     */
    public function getName(): NameInterface;

    /**
     * @return SlugInterface
     */
    public function getSlug(): SlugInterface;
}
