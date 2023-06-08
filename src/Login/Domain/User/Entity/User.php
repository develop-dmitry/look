<?php

declare(strict_types=1);

namespace Look\Login\Domain\User\Entity;

use Look\Login\Domain\User\Contract\User as UserContract;
use Look\Login\Domain\User\Value\Id;
use Look\Login\Domain\User\Value\TelegramToken;

class User implements UserContract
{
    public function __construct(
        protected ?Id $id,
        protected ?TelegramToken $telegramToken
    ) {
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function getTelegramToken(): ?TelegramToken
    {
        return $this->telegramToken;
    }
}
