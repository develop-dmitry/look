<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\LookSelection\Domain\Look\Exception\LookNotFoundException;

interface LookRepository
{
    /**
     * @param string $slug
     * @return Look
     * @throws LookNotFoundException
     */
    public function getBySlug(string $slug): Look;

    /**
     * @param string $eventSlug
     * @param float $minTemperature
     * @param float $maxTemperature
     * @return Look[]
     */
    public function findByEventAndWeather(string $eventSlug, float $minTemperature, float $maxTemperature): array;
}
