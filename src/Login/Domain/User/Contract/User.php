<?php

declare(strict_types=1);

namespace Look\Login\Domain\User\Contract;

use Look\Login\Domain\User\Value\Id;
use Look\Login\Domain\User\Value\TelegramToken;

interface User
{
    /**
     * @return Id|null
     */
    public function getId(): ?Id;

    public function getTelegramToken(): ?TelegramToken;
}
