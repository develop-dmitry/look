<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Entity;

use Look\Common\Value\Id\Contract\Id;
use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Photo\Contract\Photo;
use Look\Common\Value\Slug\Contract\Slug;
use Look\LookSelection\Domain\Clothes\Contract\Clothes as ClothesContract;
use Look\LookSelection\Domain\Style\Contract\Style;

class Clothes implements ClothesContract
{
    /**
     * @param Id $id
     * @param Name $name
     * @param Slug $slug
     * @param Photo $photo
     * @param Style[] $styles
     */
    public function __construct(
        protected Id $id,
        protected Name $name,
        protected Slug $slug,
        protected Photo $photo,
        protected array $styles
    ) {
    }

    public function getId(): Id
    {
        return $this->id;
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

    public function getStyles(): array
    {
        return $this->styles;
    }
}