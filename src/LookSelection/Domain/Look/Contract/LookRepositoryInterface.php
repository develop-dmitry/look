<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\LookSelection\Domain\Look\Exception\LookNotFoundException;

interface LookRepositoryInterface
{
    /**
     * @param string $slug
     * @return LookInterface
     * @throws LookNotFoundException
     */
    public function getBySlug(string $slug): LookInterface;

    /**
     * @param string $eventSlug
     * @param float $minTemperature
     * @param float $maxTemperature
     * @return LookInterface[]
     */
    public function findByEventAndWeather(string $eventSlug, float $minTemperature, float $maxTemperature): array;
}
