<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Contract;

interface ClothesRepositoryInterface
{
    /**
     * @param array $ids
     * @return ClothesInterface[]
     */
    public function findById(array $ids): array;
}
