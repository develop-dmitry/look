<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\User\Contract;

use Look\Common\Value\Id\Contract\Id;
use Look\LookSelection\Domain\Clothes\Contract\ClothesInterface;
use Look\LookSelection\Domain\Style\Contract\StyleInterface;

interface UserInterface
{
    /**
     * @return Id
     */
    public function getId(): Id;

    /**
     * @return StyleInterface[]
     */
    public function getStyles(): array;

    /**
     * @return ClothesInterface[]
     */
    public function getClothes(): array;
}
