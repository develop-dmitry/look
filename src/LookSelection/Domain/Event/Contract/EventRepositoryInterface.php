<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Event\Contract;

use Look\LookSelection\Domain\Event\Exception\EventNotFoundException;

interface EventRepositoryInterface
{
    /**
     * @param array $ids
     * @return EventInterface[]
     */
    public function findById(array $ids): array;

    /**
     * @param int $id
     * @return EventInterface
     * @throws EventNotFoundException
     */
    public function getById(int $id): EventInterface;
}
