<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Contract;

use Look\LookSelection\Domain\Clothes\Value\Name;
use Look\LookSelection\Domain\Clothes\Value\Photo;
use Look\LookSelection\Domain\Clothes\Value\Slug;

interface Clothes
{
    /**
     * @return Name
     */
    public function getName(): Name;

    /**
     * @return Slug
     */
    public function getSlug(): Slug;

    /**
     * @return Photo
     */
    public function getPhoto(): Photo;
}
