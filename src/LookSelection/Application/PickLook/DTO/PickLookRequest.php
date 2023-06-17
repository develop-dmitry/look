<?php

declare(strict_types=1);

namespace Look\LookSelection\Application\PickLook\DTO;

class PickLookRequest
{
    public function __construct(
        protected int $userId,
        protected int $eventId,
        protected float $minTemperature,
        protected float $maxTemperature
    ) {
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getEventId(): int
    {
        return $this->eventId;
    }

    /**
     * @return float
     */
    public function getMinTemperature(): float
    {
        return $this->minTemperature;
    }

    /**
     * @return float
     */
    public function getMaxTemperature(): float
    {
        return $this->maxTemperature;
    }
}
