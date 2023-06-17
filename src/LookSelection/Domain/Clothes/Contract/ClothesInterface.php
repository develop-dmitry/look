<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Contract;

use Look\Common\Value\Id\Contract\Id;
use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Photo\Contract\Photo;
use Look\Common\Value\Slug\Contract\Slug;
use Look\LookSelection\Domain\Style\Contract\StyleInterface;

interface ClothesInterface
{
    public function getId(): Id;

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

    /**
     * @return StyleInterface[]
     */
    public function getStyles(): array;
}
