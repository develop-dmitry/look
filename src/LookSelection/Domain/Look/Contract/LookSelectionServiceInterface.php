<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\LookSelection\Domain\Event\Contract\EventInterface;
use Look\LookSelection\Domain\User\Contract\UserInterface;
use Look\LookSelection\Domain\Weather\Contract\WeatherInterface;

interface LookSelectionServiceInterface
{
    /**
     * @param UserInterface $user
     * @param EventInterface $event
     * @param WeatherInterface $weather
     * @return LookInterface[]
     */
    public function pickLook(UserInterface $user, EventInterface $event, WeatherInterface $weather): array;
}
