<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Style\Contract;

interface StyleRepository
{
    /**
     * @param array $ids
     * @return Style[]
     */
    public function findById(array $ids): array;
}
