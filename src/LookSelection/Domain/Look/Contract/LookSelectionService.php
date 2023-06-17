<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\LookSelection\Domain\Event\Contract\Event;
use Look\LookSelection\Domain\User\Contract\User;
use Look\LookSelection\Domain\Weather\Contract\Weather;

interface LookSelectionService
{
    /**
     * @param User $user
     * @param Event $event
     * @param Weather $weather
     * @return Look[]
     */
    public function pickLook(User $user, Event $event, Weather $weather): array;
}
