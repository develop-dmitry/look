<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Season\Contract;

use Look\LookSelection\Domain\Season\Value\Name;
use Look\LookSelection\Domain\Season\Value\Slug;

interface Season
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
