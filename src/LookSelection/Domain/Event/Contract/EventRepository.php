<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Event\Contract;

interface EventRepository
{
    /**
     * @param array $ids
     * @return Event[]
     */
    public function findById(array $ids): array;
}
