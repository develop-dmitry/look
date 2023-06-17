<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Contract;

use Look\Common\Value\Id\IdInterface;
use Look\Common\Value\Name\NameInterface;
use Look\Common\Value\Photo\PhotoInterface;
use Look\Common\Value\Slug\SlugInterface;
use Look\LookSelection\Domain\Style\Contract\StyleInterface;

interface ClothesInterface
{
    public function getId(): IdInterface;

    /**
     * @return NameInterface
     */
    public function getName(): NameInterface;

    /**
     * @return SlugInterface
     */
    public function getSlug(): SlugInterface;

    /**
     * @return PhotoInterface
     */
    public function getPhoto(): PhotoInterface;

    /**
     * @return StyleInterface[]
     */
    public function getStyles(): array;
}
