<?php

declare(strict_types=1);

namespace Look\Auth\Domain\User\Entity;

use Look\Auth\Domain\User\Contract\User as UserContract;
use Look\Auth\Domain\User\Value\Id;
use Look\Auth\Domain\User\Value\TelegramToken;

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

    public function setId(Id $id): UserContract
    {
        $this->id = $id;
        return $this;
    }
}
