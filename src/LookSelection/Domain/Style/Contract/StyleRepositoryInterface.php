<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Style\Contract;

interface StyleRepositoryInterface
{
    /**
     * @param array $ids
     * @return StyleInterface[]
     */
    public function findById(array $ids): array;
}
