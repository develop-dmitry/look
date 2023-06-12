<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Entity;

use Look\LookSelection\Domain\Clothes\Contract\Clothes as ClothesContract;
use Look\LookSelection\Domain\Clothes\Value\Name;
use Look\LookSelection\Domain\Clothes\Value\Photo;
use Look\LookSelection\Domain\Clothes\Value\Slug;

class Clothes implements ClothesContract
{
    public function __construct(
        protected Name $name,
        protected Slug $slug,
        protected Photo $photo
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

    public function getPhoto(): Photo
    {
        return $this->photo;
    }
}
