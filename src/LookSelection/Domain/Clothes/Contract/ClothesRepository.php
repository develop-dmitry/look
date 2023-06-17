<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Contract;

interface ClothesRepository
{
    /**
     * @param array $ids
     * @return Clothes[]
     */
    public function findById(array $ids): array;
}
