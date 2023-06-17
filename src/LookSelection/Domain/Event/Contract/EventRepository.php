<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Event\Contract;

use Look\LookSelection\Domain\Event\Exception\EventNotFoundException;

interface EventRepository
{
    /**
     * @param array $ids
     * @return Event[]
     */
    public function findById(array $ids): array;

    /**
     * @param int $id
     * @return Event
     * @throws EventNotFoundException
     */
    public function getById(int $id): Event;
}
