<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes;

use Look\Common\Value\Id\Contract\IdInterface;
use Look\Common\Value\Name\Contract\NameInterface;
use Look\Common\Value\Photo\Contract\PhotoInterface;
use Look\Common\Value\Slug\Contract\SlugInterface;
use Look\LookSelection\Domain\Clothes\Contract\ClothesInterface;
use Look\LookSelection\Domain\Style\Contract\StyleInterface;

class Clothes implements ClothesInterface
{
    /**
     * @param IdInterface $id
     * @param NameInterface $name
     * @param SlugInterface $slug
     * @param PhotoInterface $photo
     * @param StyleInterface[] $styles
     */
    public function __construct(
        protected IdInterface    $id,
        protected NameInterface  $name,
        protected SlugInterface  $slug,
        protected PhotoInterface $photo,
        protected array          $styles
    ) {
    }

    public function getId(): IdInterface
    {
        return $this->id;
    }

    public function getName(): NameInterface
    {
        return $this->name;
    }

    public function getSlug(): SlugInterface
    {
        return $this->slug;
    }

    public function getPhoto(): PhotoInterface
    {
        return $this->photo;
    }

    public function getStyles(): array
    {
        return $this->styles;
    }
}
