<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Style\Contract;

use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Slug\Contract\Slug;

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
