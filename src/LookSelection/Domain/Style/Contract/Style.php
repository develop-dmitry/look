<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Style\Contract;

use Look\LookSelection\Domain\Style\Value\Name;
use Look\LookSelection\Domain\Style\Value\Slug;

interface Style
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
